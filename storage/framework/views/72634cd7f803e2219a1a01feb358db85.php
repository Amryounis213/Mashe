<?php $__env->startSection('title',translate('messages.Add_new_sub_category')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/sub-category.png')); ?>" alt="">
                        </div>
                        <span><?php echo e(translate('messages.Sub_Category_Setup')); ?></span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="<?php echo e(isset($category)?route('admin.category.update',[$category['id']]):route('admin.category.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                <?php ($language = $language->value ?? null); ?>
                <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                <?php if($language): ?>
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link lang_link active" href="#" id="default-link"><?php echo e(translate('Default')); ?></a>
                        </li>
                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link lang_link" href="#" id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="input-label"
                                    for="parent_id"><?php echo e(translate('messages.main_category')); ?>

                                    <span class="input-label-secondary">*</span></label>
                                <select id="parent_id" name="parent_id" class="form-control js-select2-custom" required>
                                    <option value="" selected disabled><?php echo e(translate('Select_Category')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Category::where(['position'=>0])->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat['id']); ?>" <?php echo e(isset($category)?($category['parent_id']==$cat['id']?'selected':''):''); ?> ><?php echo e($cat['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <input name="position" value="1" type="hidden">
                        </div>
                        <div class="col-md-6">

                            <div class="form-group lang_form" id="default-form">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(translate('Default')); ?>) </label>
                                <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Sub_Category_Name')); ?>"   maxlength="191">
                            </div>

                            <input type="hidden" name="lang[]" value="default">

                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Sub_Category_Name')); ?>" maxlength="191"  >
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                            <div class="form-group" id="default-form">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> <?php echo e(translate('Default')); ?></label>
                                <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Sub_Category_Name')); ?>"  maxlength="191">
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <div class="btn--container justify-content-end">
                                <!-- Static Button -->
                                <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                                <!-- Static Button -->
                                <button type="submit" class="btn btn--primary"><?php echo e(isset($category)?translate('messages.update'):translate('messages.submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header py-2 border-0">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><?php echo e(translate('messages.sub_category_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($categories->total()); ?></span></h5>
                    <form>
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input id="datatableSearch" name="search" value="<?php echo e(request()?->search ?? null); ?>" type="search" class="form-control" placeholder="<?php echo e(translate('Ex_:_Sub_Categories')); ?>" aria-label="<?php echo e(translate('messages.search_sub_categories')); ?>">
                            <input type="hidden" name="sub_category" value="1">
                            <button type="submit" class="btn btn--secondary">
                                <i class="tio-search"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "search": "#datatableSearch",
                            "entries": "#datatableEntries",
                            "isResponsive": false,
                            "isShowPaging": false,
                            "paging":false,
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('messages.sl')); ?></th>
                                <th><?php echo e(translate('messages.sub_category')); ?></th>
                                <th><?php echo e(translate('messages.id')); ?></th>
                                <th><?php echo e(translate('messages.main_category')); ?></th>
                                <th><div class="ml-3"> <?php echo e(translate('messages.priority')); ?></div></th>
                                <th class="w-100px"><?php echo e(translate('messages.status')); ?></th>
                                <th class="text-center"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="table-div">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+$categories->firstItem()); ?></td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        <?php echo e(Str::limit($category->name,20,'...')); ?>

                                    </span>
                                </td>
                                <td><?php echo e($category->id); ?></td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        <?php echo e(Str::limit($category?->parent?->name,20,'...')); ?>

                                    </span>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('admin.category.priority',$category->id)); ?>" class="priority-form">
                                    <select name="priority" id="priority" class="form-control form--control-select priority-select <?php echo e($category->priority == 0 ? 'text--title border-dark':''); ?> <?php echo e($category->priority == 1 ? 'text--info border-info':''); ?> <?php echo e($category->priority == 2 ? 'text--success border-success':''); ?> ">
                                        <option value="0" <?php echo e($category->priority == 0?'selected':''); ?>><?php echo e(translate('messages.normal')); ?></option>
                                        <option value="1" <?php echo e($category->priority == 1?'selected':''); ?>><?php echo e(translate('messages.medium')); ?></option>
                                        <option value="2" <?php echo e($category->priority == 2?'selected':''); ?>><?php echo e(translate('messages.high')); ?></option>
                                    </select>
                                    </form>
                                </td>
                                <td>
                                    <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($category->id); ?>">
                                    <input type="checkbox" data-url="<?php echo e(route('admin.category.status',[$category['id'],$category->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($category->id); ?>" <?php echo e($category->status?'checked':''); ?>>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                            href="<?php echo e(route('admin.category.edit',[$category['id']])); ?>" title="<?php echo e(translate('messages.edit_category')); ?>"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                        data-id="category-<?php echo e($category['id']); ?>" data-message="<?php echo e(translate('Want_to_delete_this_sub_category_?')); ?>" title="<?php echo e(translate('messages.delete_sub_category')); ?>"><i class="tio-delete-outlined"></i>
                                        </a>
                                    </div>
                                    <form action="<?php echo e(route('admin.category.delete',[$category['id']])); ?>" method="post" id="category-<?php echo e($category['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(count($categories) === 0): ?>
                    <div class="empty--data">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                    </div>
                    <?php endif; ?>
                    <div class="page-area px-4 pt-3 pb-0">
                        <div class="d-flex align-items-center justify-content-end">
                            <div>
                    <?php echo $categories->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/sub-category-index.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/category/sub-index.blade.php ENDPATH**/ ?>