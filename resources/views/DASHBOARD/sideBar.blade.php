<!-- Sidebar START -->
<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="#">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->


    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Formulaires</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse
            {{Route::currentRouteName()=='domaines.create'? 'show':''}}
            {{Route::currentRouteName()=='niveaux.create'? 'show':''}}
            {{Route::currentRouteName()=='matieres.create'? 'show':''}}
            {{Route::currentRouteName()=='cours.create'? 'show':''}}
            {{Route::currentRouteName()=='epreuves.create'? 'show':''}}
            {{Route::currentRouteName()=='exercices.create'? 'show':''}}

       " data-bs-parent="#sidebar-nav">
        <li {{Route::currentRouteName()=='matieres.create'? 'active':''}}>
          <a href="{{route('matieres.create')}}">
            <i class="bi bi-circle"></i><span>Matière</span>
          </a>
        </li>
        <li {{Route::currentRouteName()=='domaines.create'? 'active':''}}>
          <a href="{{route('domaines.create')}}">
            <i class="bi bi-circle"></i><span>Domaine</span>
          </a>
        </li>
        <li {{Route::currentRouteName()=='niveaux.create'? 'active':''}}>
          <a href="{{route('niveaux.create')}}">
            <i class="bi bi-circle"></i><span>Niveau</span>
          </a>
        </li>
        <li {{Route::currentRouteName()=='cours.create'? 'active':''}}>
          <a href="{{route('cours.create')}}">
            <i class="bi bi-circle"></i><span>Cours</span>
          </a>
        </li>
        <li {{Route::currentRouteName()=='epreuves.create'? 'active':''}}>
          <a href="{{route('epreuves.create')}}">
            <i class="bi bi-circle"></i><span>Epreuve</span>
          </a>
        </li>
        <li {{Route::currentRouteName()=='exercices.create'? 'active':''}}>
          <a href="{{route('exercices.create')}}">
            <i class="bi bi-circle"></i><span>Exercice</span>
          </a>
        </li>

      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse
            {{Route::currentRouteName()=='domaines.index'? 'show':''}}
            {{Route::currentRouteName()=='niveaux.index'? 'show':''}}
            {{Route::currentRouteName()=='matieres.index'? 'show':''}}
            {{Route::currentRouteName()=='cours.index'? 'show':''}}
            {{Route::currentRouteName()=='epreuves.index'? 'show':''}}
            {{Route::currentRouteName()=='exercices.index'? 'show':''}}
            {{Route::currentRouteName()=='exercices.index'? 'show':''}}
            {{Route::currentRouteName()=='corrections.index'? 'show':''}}
            " data-bs-parent="#sidebar-nav">
        <li {{Route::currentRouteName()=='matieres.index'? 'active':''}}>
            <a href="{{route('matieres.index')}}">
              <i class="bi bi-circle"></i><span>Matière</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='domaines.index'? 'active':''}}>
            <a href="{{route('domaines.index')}}">
              <i class="bi bi-circle"></i><span>Domaine</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='niveaux.index'? 'active':''}}>
            <a href="{{route('niveaux.index')}}">
              <i class="bi bi-circle"></i><span>Niveau</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='cours.index'? 'active':''}}>
            <a href="{{route('cours.index')}}">
              <i class="bi bi-circle"></i><span>Cours</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='epreuves.index'? 'active':''}}>
            <a href="{{route('epreuves.index')}}">
              <i class="bi bi-circle"></i><span>Epreuve</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='exercices.index'? 'active':''}}>
            <a href="{{route('exercices.index')}}">
              <i class="bi bi-circle"></i><span>Exercice</span>
            </a>
          </li>
          <li {{Route::currentRouteName()=='corrections.index'? 'active':''}}>
            <a href="{{route('corrections.index')}}">
              <i class="bi bi-circle"></i><span>Correction</span>
            </a>
          </li>

      </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li {{Route::currentRouteName()=='accueils.indexAccueil'? 'active':''}} class="nav-item">
      <a class="nav-link collapsed" href="{{route('accueils.indexAccueil')}}">
        <i class="ri-home-2-fill"></i>
        <span>Accueil</span>
      </a>
    </li><!-- End Profile Page Nav -->


  </ul>
<!-- Sidebar END -->
