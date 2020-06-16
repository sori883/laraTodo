<nav class="col-md-2 d-md-block sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route ('projects.index') }}">
                    <i class="fas fa-inbox"></i>
                    インボックス <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>

        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>プロジェクト</span>
            <span class="text-muted" aria-label="Add a new report" data-toggle="modal" data-target="#projectCreateModal">
                <i class="fas fa-plus-circle"></i>
            </span>
        </h6>
        <ul class="nav flex-column mb-2">
            @foreach($projects as $project)
                <li class="nav-item d-flex justify-content-between align-items-center pr-3">
                    <a class="nav-link" href="{{ route('projects.show', ['project' => $project]) }}">
                        <i class="fas fa-folder"></i>
                        {{ $project->title }}
                    </a>
                    <div class="dropdown">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">
                                記事を更新する
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#">
                                記事を削除する
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<div class="modal fade" id="projectCreateModal" tabindex="-1" role="dialog" aria-labelledby="projectCreateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectCreateModalTitle">プロジェクト作成</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="projectCreateForm" method="POST" action=" {{ route('projects.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="projectInput">プロジェクト名</label>
                        <input type="text" class="form-control" id="projectInput" name="title" placeholder="プロジェクト名" value="{{ old('projectName') }}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <button form="projectCreateForm" type="submit" class="btn btn-primary">作成</button>
            </div>
        </div>
    </div>
</div>
