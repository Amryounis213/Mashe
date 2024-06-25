<?php $__env->startSection('title',translate('messages.language')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="page-header">
        <div class="d-flex flex-wrap justify-content-between align-items-start">
            <h1 class="page-header-title mr-3">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/business.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.business_setup')); ?>

                </span>
            </h1>
            <div class="d-flex flex-wrap justify-content-end align-items-center flex-grow-1">
                <div class="blinkings active">
                    <i class="tio-info-outined"></i>
                    <div class="business-notes">
                        <h6><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" alt=""> <?php echo e(translate('Note')); ?></h6>
                        <div>
                            <?php echo e(translate('Click_the_‘+_Add_New_Language’_button_to_add_a_new_language_to_the_system')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- End Page Header -->
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex">
                                    <?php echo e(translate('Language_List')); ?>

                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <div class="d-flex gap-10 justify-content-sm-end">
                                    <button class="btn btn--primary btn-icon-split" data-toggle="modal" data-target="#lang-modal">
                                        <i class="tio-add"></i>
                                        <span class="text"><?php echo e(translate('add_new_language')); ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom" id="table-div">
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                            data-hs-datatables-options='{
                                "columnDefs": [{
                                    "targets": [],
                                    "width": "5%",
                                    "orderable": false
                                }],
                                "order": [],
                                "info": {
                                "totalQty": "#datatableWithPaginationInfoTotalQty"
                                },

                                "entries": "#datatableEntries",

                                "isResponsive": false,
                                "isShowPaging": false,
                                "paging":false
                            }'>
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('Id')); ?></th>
                                <th><?php echo e(translate('Code')); ?></th>
                                <th class="text-center"><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('default')); ?> <?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php ($language=App\Models\BusinessSetting::where('key','system_language')->first()); ?>
                            <?php if($language): ?>
                            <?php $__currentLoopData = json_decode($language['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($data['id']); ?></td>
                                    <td><?php echo e($data['code']); ?></td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($data['id']); ?>">
                                            <input type="checkbox"
                                            data-url="<?php echo e(route('admin.language.update-status')); ?>"
                                            data-id="<?php echo e($data['code']); ?>"
                                            class="toggle-switch-input    <?php echo e((array_key_exists('default', $data) && $data['default']==true) ? 'update-lang-status': 'status-update'); ?>" id="stocksCheckbox<?php echo e($data['id']); ?>" <?php echo e($data['status']==1?'checked':''); ?>>
                                            <span class="toggle-switch-label mx-auto">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="defaultCheck<?php echo e($data['id']); ?>">
                                            <input type="checkbox"  class="toggle-switch-input update-default"

                                            data-id="defaultCheck<?php echo e($data['id']); ?>"
                                            data-url="<?php echo e(route('admin.language.update-default-status', ['code'=>$data['code']])); ?>"

                                            id="defaultCheck<?php echo e($data['id']); ?>" <?php echo e(((array_key_exists('default', $data) && $data['default']==true) ? 'checked': ((array_key_exists('default', $data) && $data['default']==false) ? '' : 'disabled'))); ?>>
                                            <span class="toggle-switch-label mx-auto">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td class="text-center">


                                            <div class="btn--container justify-content-center">
                                                <?php if($data['code']!='en'): ?>
                                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn <?php echo e(( ($key== 0 ||  $key== 1 ) && env('APP_MODE') == 'demo') ?'call-demo':''); ?>" data-toggle="modal"
                                                        data-target="<?php echo e(( ($key == 0 ||  $key == 1 ) && env('APP_MODE') == 'demo') ? '' :'#lang-modal-update-'.$data['code']); ?>"
                                                         >
                                                         <i class="tio-edit"></i></a>
                                                    <?php if($data['default']==true): ?>
                                                    <?php else: ?>
                                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn <?php echo e(( ($key == 0 ||  $key == 1 ) && env('APP_MODE') == 'demo') ? 'call-demo' : 'delete'); ?>"
                                                        id="<?php echo e(( ($key == 0 ||  $key == 1 ) && env('APP_MODE') == 'demo')  ? 'javascript:' :route('admin.language.delete',[$data['code']])); ?>"><i class="tio-delete-outlined"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a class="btn btn-sm btn--warning btn-outline-warning action-btn <?php echo e(( ($key== 0 || $key== 1 ) && env('APP_MODE') == 'demo') ?'call-demo':''); ?>"
                                                    href="<?php echo e(( ($key == 0 ||  $key == 1 ) && env('APP_MODE') == 'demo') ? 'javascript:' :route('admin.language.translate',[$data['code']])); ?>">
                                                    <i class="tio-globe"></i>

                                                </a>
                                            </div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="lang-modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('new_language')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.language.add-new')); ?>" method="post"
                          style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="lang-code"
                                               class="col-form-label"><?php echo e(translate('language')); ?></label>
                                               <select id="lang-code" name="code" class="form-control js-select2-custom">
                                                <option value="af">Afrikaans</option>
                                                <option value="sq">Albanian - shqip</option>
                                                <option value="am">Amharic - አማርኛ</option>
                                                <option value="ar">Arabic - العربية</option>
                                                <option value="an">Aragonese - aragonés</option>
                                                <option value="hy">Armenian - հայերեն</option>
                                                <option value="ast">Asturian - asturianu</option>
                                                <option value="az">Azerbaijani - azərbaycan dili</option>
                                                <option value="eu">Basque - euskara</option>
                                                <option value="be">Belarusian - беларуская</option>
                                                <option value="bn">Bengali - বাংলা</option>
                                                <option value="bs">Bosnian - bosanski</option>
                                                <option value="br">Breton - brezhoneg</option>
                                                <option value="bg">Bulgarian - български</option>
                                                <option value="ca">Catalan - català</option>
                                                <option value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                                                <option value="zh">Chinese - 中文</option>
                                                <option value="zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
                                                <option value="zh-CN">Chinese (Simplified) - 中文（简体）</option>
                                                <option value="zh-TW">Chinese (Traditional) - 中文（繁體）</option>
                                                <option value="co">Corsican</option>
                                                <option value="hr">Croatian - hrvatski</option>
                                                <option value="cs">Czech - čeština</option>
                                                <option value="da">Danish - dansk</option>
                                                <option value="nl">Dutch - Nederlands</option>
                                                <option value="en-AU">English (Australia)</option>
                                                <option value="en-CA">English (Canada)</option>
                                                <option value="en-IN">English (India)</option>
                                                <option value="en-NZ">English (New Zealand)</option>
                                                <option value="en-ZA">English (South Africa)</option>
                                                <option value="en-GB">English (United Kingdom)</option>
                                                <option value="en-US">English (United States)</option>
                                                <option value="eo">Esperanto - esperanto</option>
                                                <option value="et">Estonian - eesti</option>
                                                <option value="fo">Faroese - føroyskt</option>
                                                <option value="fil">Filipino</option>
                                                <option value="fi">Finnish - suomi</option>
                                                <option value="fr">French - français</option>
                                                <option value="fr-CA">French (Canada) - français (Canada)</option>
                                                <option value="fr-FR">French (France) - français (France)</option>
                                                <option value="fr-CH">French (Switzerland) - français (Suisse)</option>
                                                <option value="gl">Galician - galego</option>
                                                <option value="ka">Georgian - ქართული</option>
                                                <option value="de">German - Deutsch</option>
                                                <option value="de-AT">German (Austria) - Deutsch (Österreich)</option>
                                                <option value="de-DE">German (Germany) - Deutsch (Deutschland)</option>
                                                <option value="de-LI">German (Liechtenstein) - Deutsch (Liechtenstein)
                                                </option>
                                                <option value="de-CH">German (Switzerland) - Deutsch (Schweiz)</option>
                                                <option value="el">Greek - Ελληνικά</option>
                                                <option value="gn">Guarani</option>
                                                <option value="gu">Gujarati - ગુજરાતી</option>
                                                <option value="ha">Hausa</option>
                                                <option value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                                                <option value="he">Hebrew - עברית</option>
                                                <option value="hi">Hindi - हिन्दी</option>
                                                <option value="hu">Hungarian - magyar</option>
                                                <option value="is">Icelandic - íslenska</option>
                                                <option value="id">Indonesian - Indonesia</option>
                                                <option value="ia">Interlingua</option>
                                                <option value="ga">Irish - Gaeilge</option>
                                                <option value="it">Italian - italiano</option>
                                                <option value="it-IT">Italian (Italy) - italiano (Italia)</option>
                                                <option value="it-CH">Italian (Switzerland) - italiano (Svizzera)</option>
                                                <option value="ja">Japanese - 日本語</option>
                                                <option value="kn">Kannada - ಕನ್ನಡ</option>
                                                <option value="kk">Kazakh - қазақ тілі</option>
                                                <option value="km">Khmer - ខ្មែរ</option>
                                                <option value="ko">Korean - 한국어</option>
                                                <option value="ku">Kurdish - Kurdî</option>
                                                <option value="ky">Kyrgyz - кыргызча</option>
                                                <option value="lo">Lao - ລາວ</option>
                                                <option value="la">Latin</option>
                                                <option value="lv">Latvian - latviešu</option>
                                                <option value="ln">Lingala - lingála</option>
                                                <option value="lt">Lithuanian - lietuvių</option>
                                                <option value="mk">Macedonian - македонски</option>
                                                <option value="ms">Malay - Bahasa Melayu</option>
                                                <option value="ml">Malayalam - മലയാളം</option>
                                                <option value="mt">Maltese - Malti</option>
                                                <option value="mr">Marathi - मराठी</option>
                                                <option value="mn">Mongolian - монгол</option>
                                                <option value="ne">Nepali - नेपाली</option>
                                                <option value="no">Norwegian - norsk</option>
                                                <option value="nb">Norwegian Bokmål - norsk bokmål</option>
                                                <option value="nn">Norwegian Nynorsk - nynorsk</option>
                                                <option value="oc">Occitan</option>
                                                <option value="or">Oriya - ଓଡ଼ିଆ</option>
                                                <option value="om">Oromo - Oromoo</option>
                                                <option value="ps">Pashto - پښتو</option>
                                                <option value="fa">Persian - فارسی</option>
                                                <option value="pl">Polish - polski</option>
                                                <option value="pt">Portuguese - português</option>
                                                <option value="pt-BR">Portuguese (Brazil) - português (Brasil)</option>
                                                <option value="pt-PT">Portuguese (Portugal) - português (Portugal)</option>
                                                <option value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                                                <option value="qu">Quechua</option>
                                                <option value="ro">Romanian - română</option>
                                                <option value="mo">Romanian (Moldova) - română (Moldova)</option>
                                                <option value="rm">Romansh - rumantsch</option>
                                                <option value="ru">Russian - русский</option>
                                                <option value="gd">Scottish Gaelic</option>
                                                <option value="sr">Serbian - српски</option>
                                                <option value="sh">Serbo-Croatian - Srpskohrvatski</option>
                                                <option value="sn">Shona - chiShona</option>
                                                <option value="sd">Sindhi</option>
                                                <option value="si">Sinhala - සිංහල</option>
                                                <option value="sk">Slovak - slovenčina</option>
                                                <option value="sl">Slovenian - slovenščina</option>
                                                <option value="so">Somali - Soomaali</option>
                                                <option value="st">Southern Sotho</option>
                                                <option value="es">Spanish - español</option>
                                                <option value="es-AR">Spanish (Argentina) - español (Argentina)</option>
                                                <option value="es-419">Spanish (Latin America) - español (Latinoamérica)
                                                </option>
                                                <option value="es-MX">Spanish (Mexico) - español (México)</option>
                                                <option value="es-ES">Spanish (Spain) - español (España)</option>
                                                <option value="es-US">Spanish (United States) - español (Estados Unidos)
                                                </option>
                                                <option value="su">Sundanese</option>
                                                <option value="sw">Swahili - Kiswahili</option>
                                                <option value="sv">Swedish - svenska</option>
                                                <option value="tg">Tajik - тоҷикӣ</option>
                                                <option value="ta">Tamil - தமிழ்</option>
                                                <option value="tt">Tatar</option>
                                                <option value="te">Telugu - తెలుగు</option>
                                                <option value="th">Thai - ไทย</option>
                                                <option value="ti">Tigrinya - ትግርኛ</option>
                                                <option value="to">Tongan - lea fakatonga</option>
                                                <option value="tr">Turkish - Türkçe</option>
                                                <option value="tk">Turkmen</option>
                                                <option value="tw">Twi</option>
                                                <option value="uk">Ukrainian - українська</option>
                                                <option value="ur">Urdu - اردو</option>
                                                <option value="ug">Uyghur</option>
                                                <option value="uz">Uzbek - o‘zbek</option>
                                                <option value="vi">Vietnamese - Tiếng Việt</option>
                                                <option value="wa">Walloon - wa</option>
                                                <option value="cy">Welsh - Cymraeg</option>
                                                <option value="fy">Western Frisian</option>
                                                <option value="xh">Xhosa</option>
                                                <option value="yi">Yiddish</option>
                                                <option value="yo">Yoruba - Èdè Yorùbá</option>
                                                <option value="zu">Zulu - isiZulu</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="direction1" class="col-form-label"><?php echo e(translate('direction')); ?> :</label>
                                        <select id="direction1" class="form-control" name="direction">
                                            <option value="ltr"><?php echo e(translate('messages.LTR')); ?></option>
                                            <option value="rtl"> <?php echo e(translate('messages.RTL')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('Add')); ?> <i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if($language): ?>

        <?php $__currentLoopData = json_decode($language['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="lang-modal-update-<?php echo e($data['code']); ?>" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('new_language')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo e(route('admin.language.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" name="code" value="<?php echo e($data['code']); ?>">
                                            <label for="lang_code"
                                                   class="col-form-label"><?php echo e(translate('language')); ?></label>
                                                   <select disabled  id="lang_code" class="form-control js-select2-custom">
                                                    <option value="af" <?php echo e($data['code']== 'af'?'selected':''); ?>>Afrikaans</option>
                                                    <option value="sq" <?php echo e($data['code']== 'sq'?'selected':''); ?>>Albanian - shqip</option>
                                                    <option value="am" <?php echo e($data['code']== 'am'?'selected':''); ?>>Amharic - አማርኛ</option>
                                                    <option value="ar" <?php echo e($data['code']== 'ar'?'selected':''); ?>>Arabic - العربية</option>
                                                    <option value="an" <?php echo e($data['code']== 'an'?'selected':''); ?>>Aragonese - aragonés</option>
                                                    <option value="hy" <?php echo e($data['code']== 'hy'?'selected':''); ?>>Armenian - հայերեն</option>
                                                    <option value="ast" <?php echo e($data['code']== 'ast'?'selected':''); ?>>Asturian - asturianu</option>
                                                    <option value="az" <?php echo e($data['code']== 'az'?'selected':''); ?>>Azerbaijani - azərbaycan dili</option>
                                                    <option value="eu" <?php echo e($data['code']== 'eu'?'selected':''); ?>>Basque - euskara</option>
                                                    <option value="be" <?php echo e($data['code']== 'be'?'selected':''); ?>>Belarusian - беларуская</option>
                                                    <option value="bn" <?php echo e($data['code']== 'bn'?'selected':''); ?>>Bengali - বাংলা</option>
                                                    <option value="bs" <?php echo e($data['code']== 'bs'?'selected':''); ?>>Bosnian - bosanski</option>
                                                    <option value="br" <?php echo e($data['code']== 'br'?'selected':''); ?>>Breton - brezhoneg</option>
                                                    <option value="bg" <?php echo e($data['code']== 'bg'?'selected':''); ?>>Bulgarian - български</option>
                                                    <option value="ca" <?php echo e($data['code']== 'ca'?'selected':''); ?>>Catalan - català</option>
                                                    <option value="ckb" <?php echo e($data['code']== 'ckb'?'selected':''); ?>>Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                                                    <option value="zh" <?php echo e($data['code']== 'zh'?'selected':''); ?>>Chinese - 中文</option>
                                                    <option value="zh-HK" <?php echo e($data['code']== 'zh-HK'?'selected':''); ?>>Chinese (Hong Kong) - 中文（香港）</option>
                                                    <option value="zh-CN" <?php echo e($data['code']== 'zh-CN'?'selected':''); ?>>Chinese (Simplified) - 中文（简体）</option>
                                                    <option value="zh-TW" <?php echo e($data['code']== 'zh-TW'?'selected':''); ?>>Chinese (Traditional) - 中文（繁體）</option>
                                                    <option value="co" <?php echo e($data['code']== 'co'?'selected':''); ?>>Corsican</option>
                                                    <option value="hr" <?php echo e($data['code']== 'hr'?'selected':''); ?>>Croatian - hrvatski</option>
                                                    <option value="cs" <?php echo e($data['code']== 'cs'?'selected':''); ?>>Czech - čeština</option>
                                                    <option value="da" <?php echo e($data['code']== 'da'?'selected':''); ?>>Danish - dansk</option>
                                                    <option value="nl" <?php echo e($data['code']== 'nl'?'selected':''); ?>>Dutch - Nederlands</option>
                                                    <option value="en-AU" <?php echo e($data['code']== 'en-AU'?'selected':''); ?>>English (Australia)</option>
                                                    <option value="en-CA" <?php echo e($data['code']== 'en-CA'?'selected':''); ?>>English (Canada)</option>
                                                    <option value="en-IN" <?php echo e($data['code']== 'en-IN'?'selected':''); ?>>English (India)</option>
                                                    <option value="en-NZ" <?php echo e($data['code']== 'en-NZ'?'selected':''); ?>>English (New Zealand)</option>
                                                    <option value="en-ZA" <?php echo e($data['code']== 'en-ZA'?'selected':''); ?>>English (South Africa)</option>
                                                    <option value="en-GB" <?php echo e($data['code']== 'en-GB'?'selected':''); ?>>English (United Kingdom)</option>
                                                    <option value="en-US" <?php echo e($data['code']== 'en-US'?'selected':''); ?>>English (United States)</option>
                                                    <option value="eo" <?php echo e($data['code']== 'eo'?'selected':''); ?>>Esperanto - esperanto</option>
                                                    <option value="et" <?php echo e($data['code']== 'et'?'selected':''); ?>>Estonian - eesti</option>
                                                    <option value="fo" <?php echo e($data['code']== 'fo'?'selected':''); ?>>Faroese - føroyskt</option>
                                                    <option value="fil" <?php echo e($data['code']== 'fil'?'selected':''); ?>>Filipino</option>
                                                    <option value="fi" <?php echo e($data['code']== 'fi'?'selected':''); ?>>Finnish - suomi</option>
                                                    <option value="fr" <?php echo e($data['code']== 'fr'?'selected':''); ?>>French - français</option>
                                                    <option value="fr-CA" <?php echo e($data['code']== 'fr-CA'?'selected':''); ?>>French (Canada) - français (Canada)</option>
                                                    <option value="fr-FR" <?php echo e($data['code']== 'fr-FR'?'selected':''); ?>>French (France) - français (France)</option>
                                                    <option value="fr-CH" <?php echo e($data['code']== 'fr-CH'?'selected':''); ?>>French (Switzerland) - français (Suisse)</option>
                                                    <option value="gl" <?php echo e($data['code']== 'gl'?'selected':''); ?>>Galician - galego</option>
                                                    <option value="ka" <?php echo e($data['code']== 'ka'?'selected':''); ?>>Georgian - ქართული</option>
                                                    <option value="de" <?php echo e($data['code']== 'de'?'selected':''); ?>>German - Deutsch</option>
                                                    <option value="de-AT" <?php echo e($data['code']== 'de-AT'?'selected':''); ?>>German (Austria) - Deutsch (Österreich)</option>
                                                    <option value="de-DE" <?php echo e($data['code']== 'de-DE'?'selected':''); ?>>German (Germany) - Deutsch (Deutschland)</option>
                                                    <option value="de-LI" <?php echo e($data['code']== 'de-LI'?'selected':''); ?>>German (Liechtenstein) - Deutsch (Liechtenstein)
                                                    </option>
                                                    <option value="de-CH" <?php echo e($data['code']== 'de-CH'?'selected':''); ?>>German (Switzerland) - Deutsch (Schweiz)</option>
                                                    <option value="el" <?php echo e($data['code']== 'el'?'selected':''); ?>>Greek - Ελληνικά</option>
                                                    <option value="gn" <?php echo e($data['code']== 'gn'?'selected':''); ?>>Guarani</option>
                                                    <option value="gu" <?php echo e($data['code']== 'gu'?'selected':''); ?>>Gujarati - ગુજરાતી</option>
                                                    <option value="ha" <?php echo e($data['code']== 'ha'?'selected':''); ?>>Hausa</option>
                                                    <option value="haw" <?php echo e($data['code']== 'haw'?'selected':''); ?>>Hawaiian - ʻŌlelo Hawaiʻi</option>
                                                    <option value="he" <?php echo e($data['code']== 'he'?'selected':''); ?>>Hebrew - עברית</option>
                                                    <option value="hi" <?php echo e($data['code']== 'hi'?'selected':''); ?>>Hindi - हिन्दी</option>
                                                    <option value="hu" <?php echo e($data['code']== 'hu'?'selected':''); ?>>Hungarian - magyar</option>
                                                    <option value="is" <?php echo e($data['code']== 'is'?'selected':''); ?>>Icelandic - íslenska</option>
                                                    <option value="id" <?php echo e($data['code']== 'id'?'selected':''); ?>>Indonesian - Indonesia</option>
                                                    <option value="ia" <?php echo e($data['code']== 'ia'?'selected':''); ?>>Interlingua</option>
                                                    <option value="ga" <?php echo e($data['code']== 'ga'?'selected':''); ?>>Irish - Gaeilge</option>
                                                    <option value="it" <?php echo e($data['code']== 'it'?'selected':''); ?>>Italian - italiano</option>
                                                    <option value="it-IT" <?php echo e($data['code']== 'it-IT'?'selected':''); ?>>Italian (Italy) - italiano (Italia)</option>
                                                    <option value="it-CH" <?php echo e($data['code']== 'it-CH'?'selected':''); ?>>Italian (Switzerland) - italiano (Svizzera)</option>
                                                    <option value="ja" <?php echo e($data['code']== 'ja'?'selected':''); ?>>Japanese - 日本語</option>
                                                    <option value="kn" <?php echo e($data['code']== 'kn'?'selected':''); ?>>Kannada - ಕನ್ನಡ</option>
                                                    <option value="kk" <?php echo e($data['code']== 'kk'?'selected':''); ?>>Kazakh - қазақ тілі</option>
                                                    <option value="km" <?php echo e($data['code']== 'km'?'selected':''); ?>>Khmer - ខ្មែរ</option>
                                                    <option value="ko" <?php echo e($data['code']== 'ko'?'selected':''); ?>>Korean - 한국어</option>
                                                    <option value="ku" <?php echo e($data['code']== 'ku'?'selected':''); ?>>Kurdish - Kurdî</option>
                                                    <option value="ky" <?php echo e($data['code']== 'ky'?'selected':''); ?>>Kyrgyz - кыргызча</option>
                                                    <option value="lo" <?php echo e($data['code']== 'lo'?'selected':''); ?>>Lao - ລາວ</option>
                                                    <option value="la" <?php echo e($data['code']== 'la'?'selected':''); ?>>Latin</option>
                                                    <option value="lv" <?php echo e($data['code']== 'lv'?'selected':''); ?>>Latvian - latviešu</option>
                                                    <option value="ln" <?php echo e($data['code']== 'ln'?'selected':''); ?>>Lingala - lingála</option>
                                                    <option value="lt" <?php echo e($data['code']== 'lt'?'selected':''); ?>>Lithuanian - lietuvių</option>
                                                    <option value="mk" <?php echo e($data['code']== 'mk'?'selected':''); ?>>Macedonian - македонски</option>
                                                    <option value="ms" <?php echo e($data['code']== 'ms'?'selected':''); ?>>Malay - Bahasa Melayu</option>
                                                    <option value="ml" <?php echo e($data['code']== 'ml'?'selected':''); ?>>Malayalam - മലയാളം</option>
                                                    <option value="mt" <?php echo e($data['code']== 'mt'?'selected':''); ?>>Maltese - Malti</option>
                                                    <option value="mr" <?php echo e($data['code']== 'mr'?'selected':''); ?>>Marathi - मराठी</option>
                                                    <option value="mn" <?php echo e($data['code']== 'mn'?'selected':''); ?>>Mongolian - монгол</option>
                                                    <option value="ne" <?php echo e($data['code']== 'ne'?'selected':''); ?>>Nepali - नेपाली</option>
                                                    <option value="no" <?php echo e($data['code']== 'no'?'selected':''); ?>>Norwegian - norsk</option>
                                                    <option value="nb" <?php echo e($data['code']== 'nb'?'selected':''); ?>>Norwegian Bokmål - norsk bokmål</option>
                                                    <option value="nn" <?php echo e($data['code']== 'nn'?'selected':''); ?>>Norwegian Nynorsk - nynorsk</option>
                                                    <option value="oc" <?php echo e($data['code']== 'oc'?'selected':''); ?>>Occitan</option>
                                                    <option value="or" <?php echo e($data['code']== 'or'?'selected':''); ?>>Oriya - ଓଡ଼ିଆ</option>
                                                    <option value="om" <?php echo e($data['code']== 'om'?'selected':''); ?>>Oromo - Oromoo</option>
                                                    <option value="ps" <?php echo e($data['code']== 'ps'?'selected':''); ?>>Pashto - پښتو</option>
                                                    <option value="fa" <?php echo e($data['code']== 'fa'?'selected':''); ?>>Persian - فارسی</option>
                                                    <option value="pl" <?php echo e($data['code']== 'pl'?'selected':''); ?>>Polish - polski</option>
                                                    <option value="pt" <?php echo e($data['code']== 'pt'?'selected':''); ?>>Portuguese - português</option>
                                                    <option value="pt-BR" <?php echo e($data['code']== 'pt-BR'?'selected':''); ?>>Portuguese (Brazil) - português (Brasil)</option>
                                                    <option value="pt-PT" <?php echo e($data['code']== 'pt-PT'?'selected':''); ?>>Portuguese (Portugal) - português (Portugal)</option>
                                                    <option value="pa" <?php echo e($data['code']== 'pa'?'selected':''); ?>>Punjabi - ਪੰਜਾਬੀ</option>
                                                    <option value="qu" <?php echo e($data['code']== 'qu'?'selected':''); ?>>Quechua</option>
                                                    <option value="ro" <?php echo e($data['code']== 'ro'?'selected':''); ?>>Romanian - română</option>
                                                    <option value="mo" <?php echo e($data['code']== 'mo'?'selected':''); ?>>Romanian (Moldova) - română (Moldova)</option>
                                                    <option value="rm" <?php echo e($data['code']== 'rm'?'selected':''); ?>>Romansh - rumantsch</option>
                                                    <option value="ru" <?php echo e($data['code']== 'ru'?'selected':''); ?>>Russian - русский</option>
                                                    <option value="gd" <?php echo e($data['code']== 'gd'?'selected':''); ?>>Scottish Gaelic</option>
                                                    <option value="sr" <?php echo e($data['code']== 'sr'?'selected':''); ?>>Serbian - српски</option>
                                                    <option value="sh" <?php echo e($data['code']== 'sh'?'selected':''); ?>>Serbo-Croatian - Srpskohrvatski</option>
                                                    <option value="sn" <?php echo e($data['code']== 'sn'?'selected':''); ?>>Shona - chiShona</option>
                                                    <option value="sd" <?php echo e($data['code']== 'sd'?'selected':''); ?>>Sindhi</option>
                                                    <option value="si" <?php echo e($data['code']== 'si'?'selected':''); ?>>Sinhala - සිංහල</option>
                                                    <option value="sk" <?php echo e($data['code']== 'sk'?'selected':''); ?>>Slovak - slovenčina</option>
                                                    <option value="sl" <?php echo e($data['code']== 'sl'?'selected':''); ?>>Slovenian - slovenščina</option>
                                                    <option value="so" <?php echo e($data['code']== 'so'?'selected':''); ?>>Somali - Soomaali</option>
                                                    <option value="st" <?php echo e($data['code']== 'st'?'selected':''); ?>>Southern Sotho</option>
                                                    <option value="es" <?php echo e($data['code']== 'es'?'selected':''); ?>>Spanish - español</option>
                                                    <option value="es-AR" <?php echo e($data['code']== 'es-AR'?'selected':''); ?>>Spanish (Argentina) - español (Argentina)</option>
                                                    <option value="es-419" <?php echo e($data['code']== 'es-419'?'selected':''); ?>>Spanish (Latin America) - español (Latinoamérica)
                                                    </option>
                                                    <option value="es-MX" <?php echo e($data['code']== 'es-MX'?'selected':''); ?>>Spanish (Mexico) - español (México)</option>
                                                    <option value="es-ES" <?php echo e($data['code']== 'es-ES'?'selected':''); ?>>Spanish (Spain) - español (España)</option>
                                                    <option value="es-US" <?php echo e($data['code']== 'es-US'?'selected':''); ?>>Spanish (United States) - español (Estados Unidos)
                                                    </option>
                                                    <option value="su" <?php echo e($data['code']== 'su'?'selected':''); ?>>Sundanese</option>
                                                    <option value="sw" <?php echo e($data['code']== 'sw'?'selected':''); ?>>Swahili - Kiswahili</option>
                                                    <option value="sv" <?php echo e($data['code']== 'sv'?'selected':''); ?>>Swedish - svenska</option>
                                                    <option value="tg" <?php echo e($data['code']== 'tg'?'selected':''); ?>>Tajik - тоҷикӣ</option>
                                                    <option value="ta" <?php echo e($data['code']== 'ta'?'selected':''); ?>>Tamil - தமிழ்</option>
                                                    <option value="tt" <?php echo e($data['code']== 'tt'?'selected':''); ?>>Tatar</option>
                                                    <option value="te" <?php echo e($data['code']== 'te'?'selected':''); ?>>Telugu - తెలుగు</option>
                                                    <option value="th" <?php echo e($data['code']== 'th'?'selected':''); ?>>Thai - ไทย</option>
                                                    <option value="ti" <?php echo e($data['code']== 'ti'?'selected':''); ?>>Tigrinya - ትግርኛ</option>
                                                    <option value="to" <?php echo e($data['code']== 'to'?'selected':''); ?>>Tongan - lea fakatonga</option>
                                                    <option value="tr" <?php echo e($data['code']== 'tr'?'selected':''); ?>>Turkish - Türkçe</option>
                                                    <option value="tk" <?php echo e($data['code']== 'tk'?'selected':''); ?>>Turkmen</option>
                                                    <option value="tw" <?php echo e($data['code']== 'tw'?'selected':''); ?>>Twi</option>
                                                    <option value="uk" <?php echo e($data['code']== 'uk'?'selected':''); ?>>Ukrainian - українська</option>
                                                    <option value="ur" <?php echo e($data['code']== 'ur'?'selected':''); ?>>Urdu - اردو</option>
                                                    <option value="ug" <?php echo e($data['code']== 'ug'?'selected':''); ?>>Uyghur</option>
                                                    <option value="uz" <?php echo e($data['code']== 'uz'?'selected':''); ?>>Uzbek - o‘zbek</option>
                                                    <option value="vi" <?php echo e($data['code']== 'vi'?'selected':''); ?>>Vietnamese - Tiếng Việt</option>
                                                    <option value="wa" <?php echo e($data['code']== 'wa'?'selected':''); ?>>Walloon - wa</option>
                                                    <option value="cy" <?php echo e($data['code']== 'cy'?'selected':''); ?>>Welsh - Cymraeg</option>
                                                    <option value="fy" <?php echo e($data['code']== 'fy'?'selected':''); ?>>Western Frisian</option>
                                                    <option value="xh" <?php echo e($data['code']== 'xh'?'selected':''); ?>>Xhosa</option>
                                                    <option value="yi" <?php echo e($data['code']== 'yi'?'selected':''); ?>>Yiddish</option>
                                                    <option value="yo" <?php echo e($data['code']== 'yo'?'selected':''); ?>>Yoruba - Èdè Yorùbá</option>
                                                    <option value="zu" <?php echo e($data['code']== 'zu'?'selected':''); ?>>Zulu - isiZulu</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="direction" class="col-form-label"><?php echo e(translate('direction')); ?> :</label>
                                            <select id="direction" class="form-control" name="direction">
                                                <option
                                                    value="ltr" <?php echo e(isset($data['direction'])?$data['direction']=='ltr'?'selected':'':''); ?>>
                                                    <?php echo e(translate('messages.LTR')); ?>

                                                </option>
                                                <option
                                                    value="rtl" <?php echo e(isset($data['direction'])?$data['direction']=='rtl'?'selected':'':''); ?>>
                                                    <?php echo e(translate('messages.RTL')); ?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(translate('update')); ?> <i
                                        class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
     "use strict"
        $(".update-lang-status").click(function (e) {
                e.preventDefault();
                toastr.warning('<?php echo e(translate('default_language_status_can_not_be_updated!_to_update_change_the_default_language_first!')); ?>');
        });

            $(".delete").click(function (e) {
                e.preventDefault();

                Swal.fire({
                    title: '<?php echo e(translate('Want to delete this language')); ?> ?',
                    text: "<?php echo e(translate('If_yes,_the_language_will_be_removed_from_the_system_and_you_can’t_revert_it')); ?> !",
                    showCancelButton: true,
                    confirmButtonColor: 'primary',
                    cancelButtonColor: 'secondary',
                    cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                    confirmButtonText: '<?php echo e(translate('Yes')); ?>, <?php echo e(translate('delete it')); ?>!'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = $(this).attr("id");
                    }
                })
            });
            $(".status-update").click(function () {
                $.get({
                    url: $(this).data('url'),
                    data: {
                        code: $(this).data('id'),
                    },

                    success: function (data) {
                    if (data.error === 403) {
                        toastr.error('<?php echo e(translate('status_can_not_be_updated')); ?>');
                        location.reload();
                    }
                    else{
                        toastr.success('<?php echo e(translate('status_updated_successfully')); ?>');
                    }
                }
                });
            });

            $(".update-default").click(function () {
                window.location.href = $(this).data('url');
            });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/language/index.blade.php ENDPATH**/ ?>