<?php

namespace Domain\Orders\Actions;

use Domain\Customers\Models\Customer;
use Domain\Orders\Models\Order;
use Domain\Orders\Models\OrderFileAttachment;
use Domain\Orders\Models\OrderLine;
use Domain\ProductCustomizations\Models\ProductCustomization;
use Domain\Products\Models\ProductCombination;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;


class AddExclusiveNumberToPdfAction
{
    //NEW DIMENSIONS (ALL CUSTOM DESIGNS)
    const WIDTH_CUSTOM = 594;
    const HEIGHT_CUSTOM = 420;

    //ADAPTED TO YOU FILE DIMENSIONS
    const WIDTH_ADAPTED = 210;
    const HEIGHT_ADAPTED = 297;

    //IS NOT NECESSARY TO DEFINE  DIMENSIONS OF WEB DESIGNS BECAUSE THEY ARE STANDARD/DEFAULT MPDF ONES.

    public function __invoke
    (
        OrderLine $orderLine,
    ): ?bool
    {
        if (!$orderLine->exclusive_number) {
            return false;
        }

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $fontDir = array_merge($fontDirs, [
            resource_path('fonts'),
        ]);
        $fontData = $fontData + [
                'montserrat' => [
                    'B' => 'Montserrat-SemiBold.ttf',
                ]
            ];

        //Product Customization use standard Dimentions (A3 or A4), so it's not necessary to read or define the width and height variables.
        if ($orderLine->orderlineable_type == ProductCustomization::class) {
            $pdf = new Mpdf(['orientation' => 'L', 'fontDir' => $fontDir, 'fontdata' => $fontData]);
            $original_pdf = storage_path("app/customized-products/" . $orderLine->orderlineable->id . "/design.pdf");
            $pagecount = $pdf->SetSourceFile($original_pdf);
            for ($i = 1; $i <= $pagecount; $i++) {
                $pdf->AddPage();
                $tplId = $pdf->importPage($i);
                $pdf->SetFont('montserrat', 'B', 16);
                $pdf->useTemplate($tplId);
                //New design exclusive number print
                $pdf->WriteText('60', '20', utf8_encode($orderLine->exclusive_number));
                $pdf->SetFont('montserrat', 'B', 14);
                $pdf->WriteHTML('<div style="margin-left: 170px; margin-top: 270px; font-size:1px; font-family: Montserrat"><a target="_blank" href="https://marinaracewear.com/en/product/c-' . $orderLine->orderlineable->product->slug . '/' . json_decode($orderLine->customization)->share_code . '"style="color:white;">'.utf8_encode(json_decode($orderLine->customization)->share_code).'</a></div>');
                $pdf->WriteHTML('<div style="margin-left: 185px; margin-top: 25px; font-size:14px; font-weight: bold; font-family: Montserrat,serif"><a target="_blank" href="https://marinaracewear.com/en/product/c-' . $orderLine->orderlineable->product->slug . '/' . json_decode($orderLine->customization)->share_code . '"style="color:blue;">'.utf8_encode(json_decode($orderLine->customization)->share_code).'</a></div>');
            }
            try {
                Storage::disk('local')->makeDirectory('exclusives-generades/' . $orderLine->exclusive_number);
                $pdf->Output(storage_path("app/exclusives-generades/" . $orderLine->exclusive_number . "/Pdf " . $orderLine->exclusive_number . ".pdf"), "F");
            } catch (MpdfException $e) {
            }

            if ($orderLine->hasAdaptedToYou() && (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.pdf') || Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.ai'))) {
                if(Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.pdf')) {
                    $adapted_to_you_pdf = storage_path("app/customized-products/" . $orderLine->orderlineable->id . "/adapted_to_you.pdf");
                }
                if(Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.ai')) {
                    $adapted_to_you_pdf = storage_path("app/customized-products/" . $orderLine->orderlineable->id . "/adapted_to_you.ai");
                }
                $extension = pathinfo($adapted_to_you_pdf, PATHINFO_EXTENSION);
                if($extension == 'pdf' || $extension == 'ai') {
                    $new_adapted_pdf = new Mpdf(['format' => [self::HEIGHT_ADAPTED, self::WIDTH_ADAPTED], 'fontDir' => $fontDir, 'fontdata' => $fontData]);
                    try {
                        $pagecount = $new_adapted_pdf->SetSourceFile($adapted_to_you_pdf);
                    } catch (Exception $e) {
                        Log::error("Error Tecnica Compressió PDF Adapted yo you");
                        Storage::disk('local')->makeDirectory('exclusives-generades/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF MIDES');
                        Storage::disk('local')->makeDirectory('exclusives-pendents/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF MIDES');
                        Log::error($e->getMessage());
                        return true;
                    }
                    for ($i = 1; $i <= $pagecount; $i++) {
                        $new_adapted_pdf->AddPage('L');
                        $tplId = $new_adapted_pdf->importPage($i);
                        $new_adapted_pdf->SetFont('montserrat', '', 12);
                        $new_adapted_pdf->useTemplate($tplId, 0, 0, self::WIDTH_ADAPTED, self::HEIGHT_ADAPTED);
                        $new_adapted_pdf->WriteHTML('<div style="margin-left: 275px; margin-top: 28px; color:red; font-size:14px; font-weight: bold; font-family: Montserrat,serif">EXC. ' . utf8_encode($orderLine->exclusive_number) . '</div>');
                    }
                    try {
                        $new_adapted_pdf->Output(storage_path("app/customized-products/" . $orderLine->orderlineable->id . "/adapted_to_you.pdf"), "F");
                    } catch (MpdfException $e) {
                    }
                }
                Storage::disk('local')->put('exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.' . $extension, file_get_contents($adapted_to_you_pdf));
            }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.jpeg')) {
                    Storage::copy('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.jpeg', '/exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.jpeg');
                }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.png')) {
                    Storage::copy('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.png', '/exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.png');
                }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.jpg')) {
                    Storage::copy('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.jpg', '/exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.jpg');
                }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.svg')) {
                    Storage::copy('/customized-products/' . $orderLine->orderlineable->id . '/adapted_to_you.svg', '/exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.svg');
                }

            //Copy flags/logos/texts folders to exclusives-generades folder
            //if exist logos or text or banderas
            if ((Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/flags')) || (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/logos')) || (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/texts'))) {
                //- create directory material grafic i dintre les 3 subcarpetes
                Storage::disk('local')->makeDirectory('exclusives-generades/' . $orderLine->exclusive_number . '/Material grafic ' . $orderLine->exclusive_number);
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/flags')) {
                    File::copyDirectory(base_path('storage/app/customized-products/' . $orderLine->orderlineable->id . '/flags'), base_path('storage/app/exclusives-generades/' . $orderLine->exclusive_number . '/Material grafic ' . $orderLine->exclusive_number .  '/flags ' . $orderLine->exclusive_number));
                }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/logos')) {
                    File::copyDirectory(base_path('storage/app/customized-products/' . $orderLine->orderlineable->id . '/logos'), base_path('storage/app/exclusives-generades/' . $orderLine->exclusive_number . '/Material grafic ' . $orderLine->exclusive_number .  '/logos ' . $orderLine->exclusive_number));
                }
                if (Storage::disk('local')->exists('/customized-products/' . $orderLine->orderlineable->id . '/texts')) {
                    File::copyDirectory(base_path('storage/app/customized-products/' . $orderLine->orderlineable->id . '/texts'), base_path('storage/app/exclusives-generades/' . $orderLine->exclusive_number . '/Material grafic ' . $orderLine->exclusive_number .  '/texts ' . $orderLine->exclusive_number));
                }
            }

            //Duplicar a exclusives-pendents la nova exclusiva i guardar en zip a customized-products i a exclusives-generades (per tenir una copia sempre per mail i backoffice)
            File::copyDirectory(base_path('storage/app/exclusives-generades/' . $orderLine->exclusive_number), base_path('storage/app/exclusives-pendents/' . $orderLine->exclusive_number));
            Storage::disk('local')->delete('/customized-products/' . $orderLine->orderlineable->id . '/' . $orderLine->orderlineable->id . '.zip');
            $this->zip(
                storage_path('app/customized-products/' . $orderLine->orderlineable->id . '/'),
                storage_path('app/customized-products/' . $orderLine->orderlineable->id . '/' . $orderLine->exclusive_number . '.zip')
            );
            $this->zip(
                storage_path('app/exclusives-generades/' . $orderLine->exclusive_number . '/'),
                storage_path('app/exclusives-generades/' . $orderLine->exclusive_number . '/' . $orderLine->exclusive_number . '.zip')
            );

        } elseif ($orderLine->orderlineable_type == ProductCombination::class) {
            // Size of pdf
            $pdf = new Mpdf(['format' => [self::HEIGHT_CUSTOM, self::WIDTH_CUSTOM], 'fontDir' => $fontDir, 'fontdata' => $fontData]);
            $files = $orderLine->getOrderFileAttachments();
            foreach ($files as $k => $orderFileAttachment) {
                $file = $orderFileAttachment->getFirstMedia('order-file-attachments');
                //Print exclusive number for the first pdf file (design) and not for the second (adapted_to_you)
                if ($file && $k == 0) {
                    $original_pdf = $file->getPath();
                    try {
                        $pagecount = $pdf->SetSourceFile($original_pdf);
                    } catch (Exception $e) {
                        Log::error("Error Tecnica Compressió PDF Custom");
                        Storage::disk('local')->makeDirectory('exclusives-generades/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF');
                        Storage::disk('local')->makeDirectory('exclusives-pendents/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF');
                        Log::error($e->getMessage());
                        return true;
                    }
                    for ($i = 1; $i <= $pagecount; $i++) {
                        $pdf->AddPage('L');
                        $tplId = $pdf->importPage($i);
                        $pdf->SetFont('montserrat', 'B', 30);
                        $pdf->useTemplate($tplId, 0, 0, self::WIDTH_CUSTOM, self::HEIGHT_CUSTOM);
                        $pdf->WriteText('130', '40', utf8_encode($orderLine->exclusive_number));
                    }
                    try {
                        $pdf->Output($file->getPath(), "F");
                        Storage::disk('local')->put('exclusives-generades/' . $orderLine->exclusive_number . '/Pdf ' . $orderLine->exclusive_number . '.pdf', file_get_contents($original_pdf));
                    } catch (MpdfException $e) {
                    }
                } elseif ($file && $k == 1) {
                    $adapted_to_you_pdf = $file->getPath();
                    $extension = pathinfo($adapted_to_you_pdf, PATHINFO_EXTENSION);
                    if($extension == 'pdf' || $extension == 'ai') {
                        $new_adapted_pdf = new Mpdf(['format' => [self::HEIGHT_ADAPTED, self::WIDTH_ADAPTED], 'fontDir' => $fontDir, 'fontdata' => $fontData]);
                        try {
                            $pagecount = $new_adapted_pdf->SetSourceFile($adapted_to_you_pdf);
                        } catch (Exception $e) {
                            Log::error("Error Tecnica Compressió PDF Adapted yo you");
                            Storage::disk('local')->makeDirectory('exclusives-generades/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF MIDES');
                            Storage::disk('local')->makeDirectory('exclusives-pendents/' . $orderLine->exclusive_number . 'ERROR COMPRESSIO PDF MIDES');
                            Log::error($e->getMessage());
                            return true;
                        }
                        for ($i = 1; $i <= $pagecount; $i++) {
                            $new_adapted_pdf->AddPage('L');
                            $tplId = $new_adapted_pdf->importPage($i);
                            $new_adapted_pdf->SetFont('montserrat', '', 12);
                            $new_adapted_pdf->useTemplate($tplId, 0, 0, self::WIDTH_ADAPTED, self::HEIGHT_ADAPTED);
                            $new_adapted_pdf->WriteHTML('<div style="margin-left: 275px; margin-top: 28px; color:red; font-size:14px; font-weight: bold; font-family: Montserrat,serif">EXC. ' . utf8_encode($orderLine->exclusive_number) . '</div>');
                         }
                        try {
                            $new_adapted_pdf->Output($file->getPath(), "F");
                            Storage::disk('local')->put('exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.pdf', file_get_contents($adapted_to_you_pdf));
                        } catch (MpdfException $e) {
                        }
                    } else {
                        //We now accept multiple extensions for adapted to you file. So we save that extension in order to rename the exclusive file with that extension (not always pdf).
                        Storage::disk('local')->put('exclusives-generades/' . $orderLine->exclusive_number . '/Mides ' . $orderLine->exclusive_number . '.' . $extension, file_get_contents($adapted_to_you_pdf));
                    }
                }
            }
            File::copyDirectory(base_path('storage/app/exclusives-generades/' . $orderLine->exclusive_number), base_path('storage/app/exclusives-pendents/' . $orderLine->exclusive_number));
        }

        return true;

    }

    private function zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new \ZipArchive();
        if (!$zip->open($destination, \ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }
}
