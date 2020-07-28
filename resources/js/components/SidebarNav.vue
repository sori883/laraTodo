<template>
<nav class="col-md-2 d-md-block sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-inbox"></i>
                    インボックス <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>

        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>プロジェクト</span>
            <span class="text-muted" data-toggle="modal" data-target="#projectCreateModal">
                <i class="fas fa-plus-circle"></i>
            </span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item d-flex justify-content-between align-items-center pr-3">
                <a class="nav-link" href="#">
                    <i class="fas fa-folder"></i>
                    直打ち
                </a>
                <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h text-muted"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" data-target="#ProjectEditModal">
                            プロジェクトを編集
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#ProjectDeleteModal">
                            プロジェクトを削除
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
</template>

<script>
export default {

}
</script>
