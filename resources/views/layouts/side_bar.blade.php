<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{route('home')}}" class="simple-text">
                {{Config::get('app.name')}}
            </a>
        </div>
        <ul class="nav">
            <li @if(request()->route()->getName() == 'home') class="nav-item active" @endif>
                <a class="nav-link" href="{{route('home')}}">
                    <i class="nc-icon nc-grid-45"></i>
                    <p>Get The Count</p>
                </a>
            </li>
            <li @if(request()->route()->getName() == 'all.file.list') class="nav-item active" @endif>
                <a class="nav-link" href="{{route('all.file.list')}}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Files List</p>
                </a>
            </li>
            <li @if(request()->route()->getName() == 'upload.file.index') class="nav-item active" @endif>
                <a class="nav-link" href="{{route('upload.file.index')}}">
                    <i class="nc-icon nc-cloud-upload-94"></i>
                    <p>Upload New File</p>
                </a>
            </li>
        </ul>
    </div>
</div>