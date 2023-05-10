<header>
    <nav id="main-menu" class="left-0 right-0 top-0 z-40" x-data="measures()">
        <div
            class="w-100 flex items-center justify-between relative z-20 px-6 py-1 transition-all duration-200 ease-in-out bg-gray-900 text-brand-gray-lighter">
            <div></div>
            <div class="flex items-center ml-32">

                <div id="logo" class="text-center">
                    <a href="/">
                        <svg class="block scale-90" width="116" height="33" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M52.128 12.282v6.976h-4.965V0h7.58c2.54 0 4.4.425 5.584 1.28 1.182.846 1.772 2.196 1.772 4.033 0 1.275-.311 2.32-.925 3.136-.612.817-1.54 1.42-2.778 1.805.679.155 1.292.507 1.824 1.051.544.547 1.085 1.376 1.637 2.486l2.692 5.467h-5.287l-2.353-4.787c-.47-.961-.947-1.305-1.436-1.657-.483-.356-1.133-.532-1.941-.532h-1.404zm2.09-3.744c1.037 0 1.787-.19 2.239-.578.449-.388.677-1.026.677-1.909 0-.877-.228-1.505-.677-1.885-.452-.378-1.202-.568-2.24-.568h-2.09v4.94h2.09zM66.467 19.258h4.96V0h-4.96zM75.266 0h5.547l7.004 13.208V0h4.702v19.257h-5.542L79.973 6.051v13.206h-4.707zM25.052 19.258L32.185 0h5.922l7.136 19.257h-4.995L39.02 15.75h-.01L36.099 7.22l-.02.008-.938-2.714-2.632 7.665h3.485l1.185 3.486h-5.89l-1.243 3.593zM114.627 19.258L107.494 0h-5.922l-7.13 19.257h4.989l1.227-3.507h.01l2.912-8.531.022.008.936-2.714 2.636 7.665h-3.49l-1.181 3.486h5.887l1.243 3.593zM11.715 8.721L19.129.012h4.006v19.245h-4.707V8.721l-2.921 3.467z"
                                fill="#999693"
                            />
                            <path fill="#AB172C"
                                  d="M0 .012v19.245h4.707V8.721l2.919 3.464 3.794-3.464L4.005.012z"/>
                            <path
                                d="M29.684 26.026h-1.362v1.948h1.362c.63 0 1.044-.402 1.044-.972 0-.571-.413-.976-1.044-.976zm1.12 6.092l-1.446-2.941h-1.036v2.94h-1.438v-7.373h2.893c1.5 0 2.39 1.027 2.39 2.258 0 1.034-.631 1.676-1.344 1.938l1.646 3.178h-1.665zM37.168 26.919l-.929 2.682h1.83l-.901-2.682zm1.72 5.199l-.431-1.304H35.83l-.442 1.304h-1.501l2.682-7.374h1.126l2.694 7.374h-1.501zM44.7 32.181c-.789 0-1.455-.27-1.988-.807a2.162 2.162 0 01-.604-1.11c-.082-.412-.125-1.027-.125-1.834 0-.808.043-1.418.125-1.835.083-.423.283-.786.604-1.105.533-.539 1.2-.809 1.988-.809 1.418 0 2.463.828 2.713 2.331h-1.459c-.154-.633-.55-1.048-1.243-1.048-.396 0-.707.124-.923.384-.305.323-.362.653-.362 2.082 0 1.43.057 1.764.362 2.083.216.257.527.383.923.383.693 0 1.09-.416 1.243-1.044h1.46c-.25 1.501-1.307 2.33-2.714 2.33M49.691 32.117v-7.374h4.856v1.282H51.13v1.733h2.913v1.282H51.13v1.795h3.418v1.282zM63.28 32.117h-1.2l-1.357-4.473-1.362 4.473h-1.197l-1.972-7.374h1.502l1.144 4.648 1.344-4.648h1.075l1.346 4.648 1.154-4.648h1.502zM67.213 32.117v-7.374h4.857v1.282h-3.418v1.733h2.913v1.282h-2.913v1.795h3.418v1.282zM76.992 26.919L76.06 29.6h1.833l-.9-2.682zm1.72 5.199l-.435-1.304h-2.62l-.449 1.304h-1.5l2.68-7.374h1.132l2.69 7.374h-1.498zM84.959 26.026h-1.36v1.948h1.36c.631 0 1.044-.402 1.044-.972 0-.571-.413-.976-1.044-.976zm1.117 6.092l-1.443-2.941h-1.034v2.94h-1.441v-7.373h2.891c1.504 0 2.393 1.027 2.393 2.258 0 1.034-.63 1.676-1.346 1.938l1.648 3.178h-1.668z"
                                fill="#FFF"
                            />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex items-center space-x-5 scale-100 xl:scale-115 mr-0 xl:mr-3">

                <div class="lg:relative">
                    <a
                        class="{{ Auth::guard('customer')->check()
                                    ? Auth::guard('customer')->user()->isDealer() ? 'text-black' : 'text-white'
                                    : ''
                           }}"
                        href="{{ Auth::guard('customer')->check() ? route('my-account') : route('login') }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    </a>
                </div>
                <div class="lg:relative">
                    <div class="cursor-pointer flex items-center space-x-1 text-sm" @click="goOrHide('locale')">
                        <span class="font-semibold uppercase text-xs">{{ app()->getLocale() }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                             class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </div>
                    <div
                        x-show="showMenu === 'locale'"
                        class="menu-under-item @if(Auth::guard('customer')->check() && auth::guard('customer')->user()->isDealer())bg-[#e6e6e6] @else bg-gray-900 @endif bg-opacity-80">
                        <x-language-selector></x-language-selector>
                    </div>
                </div>
                <div class="flex items-center space-x-5 scale-100 xl:scale-115 mr-0 xl:mr-3">
                    <div class="lg:relative">
                        <a href="{{route('home')}}" class="hover:text-brand-red">{{__("Exit")}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-px bg-brand-red"></div>
    </nav>
</header>
