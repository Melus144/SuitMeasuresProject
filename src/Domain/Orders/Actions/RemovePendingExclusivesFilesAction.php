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


class RemovePendingExclusivesFilesAction
{

    public function __invoke
    (

    ): ?bool
    {
         foreach(array_map('basename',File::directories(storage_path('app/exclusives-pendents/'))) as $exclusiva) {
             if (Storage::disk('local')->exists('/exclusives-historic/' . $exclusiva .'/')) {
                 Storage::disk('local')->deleteDirectory('/exclusives-pendents/' . $exclusiva .'/');
             }
         }
        return true;

    }

}
