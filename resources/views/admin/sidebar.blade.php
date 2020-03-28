<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>

        @php
        $data = auth()->user()->name;
        @endphp
        <div class="info">
          <a href="#" class="d-block">Welcome, {{$data}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item has-treeview {{((Route::currentRouteName()) == ('group.create')) || ((Route::currentRouteName()) == ('group.index'))  || ((Route::currentRouteName()) == ('group.edit')) ? 'menu-open' : ''}}">

             <a href="#" class="nav-link {{((Route::currentRouteName()) == ('group.create')) || ((Route::currentRouteName()) == ('group.index'))  || ((Route::currentRouteName()) == ('group.edit')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Group
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('group.create')}}" class="nav-link {{((Route::currentRouteName()) == ('group.create')) ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('group.index')  }}" class="nav-link {{((Route::currentRouteName()) == ('group.index')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview {{((Route::currentRouteName()) == ('building.create')) || ((Route::currentRouteName()) == ('building.index'))  || ((Route::currentRouteName()) == ('building.edit')) ? 'menu-open' : ''}}">

            <a href="#" class="nav-link {{((Route::currentRouteName()) == ('building.create')) || ((Route::currentRouteName()) == ('building.index'))  || ((Route::currentRouteName()) == ('building.edit')) ? 'active' : ''}}">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Buildings
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('building.create')}}" class="nav-link {{((Route::currentRouteName()) == ('building.create')) ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('building.index')  }}" class="nav-link {{((Route::currentRouteName()) == ('building.index')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          

          <li class="nav-item has-treeview {{((Route::currentRouteName()) == ('labourType.create')) || ((Route::currentRouteName()) == ('labourType.index'))  || ((Route::currentRouteName()) == ('labourType.edit')) ? 'menu-open' : ''}}">

            <a href="#" class="nav-link {{((Route::currentRouteName()) == ('labourType.create')) || ((Route::currentRouteName()) == ('labourType.index'))  || ((Route::currentRouteName()) == ('labourType.edit'))  ? 'active' : ''}}">
              <i class="nav-icon fa fa-circle"></i>
              <p>
                Labour Type
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('labourType.create')}}" class="nav-link {{((Route::currentRouteName()) == ('labourType.create')) ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('labourType.index')  }}" class="nav-link {{((Route::currentRouteName()) == ('labourType.index')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>List</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item has-treeview {{((Route::currentRouteName()) == ('labour.create')) || ((Route::currentRouteName()) == ('labour.index'))  || ((Route::currentRouteName()) == ('labour.edit')) ||  ((Route::currentRouteName()) == ('labour.show'))? 'menu-open' : ''}}">

            <a href="#" class="nav-link {{((Route::currentRouteName()) == ('labour.create')) || ((Route::currentRouteName()) == ('labour.index'))  || ((Route::currentRouteName()) == ('labour.edit')) || ((Route::currentRouteName()) == ('labour.show')) ? 'active' : ''}}">
              <i class="nav-icon fa fa-credit-card"></i>
              <p>
                Salary
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('labour.create')}}" class="nav-link {{((Route::currentRouteName()) == ('labour.create')) ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add Labour</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('labour.index')  }}" class="nav-link {{((Route::currentRouteName()) == ('labour.index')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Salary List</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item has-treeview {{((Route::currentRouteName()) == ('groupCost.report')) || ((Route::currentRouteName()) == ('labour.find')) || ((Route::currentRouteName()) == ('buildingCost.report'))? 'menu-open' : ''}}">

            <a href="#" class="nav-link {{((Route::currentRouteName()) == ('groupCost.report')) || ((Route::currentRouteName()) == ('labour.find')) || ((Route::currentRouteName()) == ('buildingCost.report')) ? 'active' : ''}}">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Reports
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('labour.find')}}" class="nav-link {{((Route::currentRouteName()) == ('labour.find')) ? 'active' : ''}}">
                  <i class="fa fa-search nav-icon"></i>
                  <p>Find Labour</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('buildingCost.report')  }}" class="nav-link {{((Route::currentRouteName()) == ('buildingCost.report')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Building Wise Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{  route('groupCost.report')  }}" class="nav-link {{((Route::currentRouteName()) == ('groupCost.report')) ? 'active' : ''}}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Group Wise Report</p>
                </a>
              </li>

            </ul>
          </li>

          <li >

            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>



        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

