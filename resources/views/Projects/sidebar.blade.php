<nav id="sidebarMenu" class="col-md-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route ('projects.index') }}">
            <i class="fas fa-inbox"></i>
            インボックス <span class="sr-only">(current)</span>
            </a>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>プロジェクト</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <i class="fas fa-plus-circle"></i>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
            @foreach($projects as $project)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.show', ['project' => $project]) }}">
                        <i class="fas fa-folder"></i>
                        {{ $project->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
