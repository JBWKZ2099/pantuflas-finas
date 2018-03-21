<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <?php /*
    <li class="nav-item <?php if( $active_menu=="charts_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Histórico">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="charts_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#graphsCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-area-chart"></i>
        <span class="nav-link-text">
          Gráficas</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="charts" ) echo "show"; ?>" id="graphsCollapse">
        <li <?php if( $active_opt=="charts" ) echo "class='active'"; ?>>
          <a href="charts">Ver</a>
        </li>
        <?php if( user()["permission"]==1 ) { ?>
          <li <?php if( $active_opt=="charts-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>charts-create">Crear / Actualizar</a>
          </li>
          <li <?php if( $active_opt=="charts-update" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>charts-update">Actualizar títulos</a>
          </li>
        <?php } ?>
      </ul>
    </li>
    <li class="nav-item <?php if( $active_menu=="historic_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Histórico">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="historic_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#historyCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-file-pdf-o"></i>
        <span class="nav-link-text">
          Histórico</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="historic" ) echo "show"; ?>" id="historyCollapse">
        <li <?php if( $active_opt=="historic-view" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>historics">Lista de Históricos</a>
        </li>
        <?php if( user()["permission"]==1 ) { ?>
          <li <?php if( $active_opt=="historic-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>historics-create">Agregar Histórico</a>
          </li>
          <li <?php if( $active_opt=="historic-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>historics-deleted">Históricos Eliminados</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  */ ?>
  <?php if( userAccess()["catalogue"]==1 ) { ?>
  <li class="nav-item <?php if( $active_menu=="masload_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Catálogo">
    <a class="nav-link nav-link-collapse <?php if( $active_menu=="masload_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#catalogueCollapse" data-parent="#exampleAccordion">
      <i class="fa fa-fw fa-file-text"></i>
      <span class="nav-link-text">
        Catálogo</span>
    </a>
    <ul class="sidenav-second-level collapse <?php if( $collapse=="masload" ) echo "show"; ?>" id="catalogueCollapse">
      <li <?php if( $active_opt=="masload-create" ) echo "class='active'"; ?>>
        <a href="<?php echo $abs_path."/"; ?>massive-load-create">Carga masiva</a>
      </li>
      <li <?php if( $active_opt=="product-create" ) echo "class='active'"; ?>>
        <a href="<?php echo $abs_path."/"; ?>product-create">Agregar producto</a>
      </li>
    </ul>
  </li>
  <?php } ?>
  <?php if( userAccess()["request"]==1 ) { ?>
  <li class="nav-item <?php if( $active_menu=="request_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Solicitud">
    <a class="nav-link nav-link-collapse <?php if( $active_menu=="request_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#requestCollapse" data-parent="#exampleAccordion">
      <i class="fa fa-fw fa-file-text"></i>
      <span class="nav-link-text">
        Solicitud</span>
    </a>
    <ul class="sidenav-second-level collapse <?php if( $collapse=="request" ) echo "show"; ?>" id="requestCollapse">
      <li <?php if( $active_opt=="request-view" ) echo "class='active'"; ?>>
        <a href="<?php echo $abs_path."/"; ?>request-view">Ver solicitudes</a>
      </li>
    </ul>
  </li>
  <?php } ?>
  <?php if( userAccess()["manteinance"]==1 ) { ?>
  <li class="nav-item <?php if( $active_menu=="manteinance_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Solicitud">
    <a class="nav-link nav-link-collapse <?php if( $active_menu=="manteinance_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#manteinanceCollapse" data-parent="#exampleAccordion">
      <i class="fa fa-fw fa-wrench"></i>
      <span class="nav-link-text">
        Mantenimiento</span>
    </a>
    <ul class="sidenav-second-level collapse <?php if( $collapse=="manteinance" ) echo "show"; ?>" id="manteinanceCollapse">
      <li <?php if( $active_opt=="manteinance-edit" ) echo "class='active'"; ?>>
        <a href="<?php echo $abs_path."/"; ?>manteinance-edit">Modificar información</a>
      </li>
    </ul>
  </li>
  <?php } ?>
  <?php if( userAccess()["my_account"]==1 /*&& user()["permission"]!=1*/ ) { ?>
  <li class="nav-item <?php if( $active_menu=="manteinance_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Solicitud">
    <a class="nav-link nav-link-collapse <?php if( $active_menu=="manteinance_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#myaccountCollapse" data-parent="#exampleAccordion">
      <i class="fa fa-fw fa-user"></i>
      <span class="nav-link-text">
        Mi Cuenta</span>
    </a>
    <ul class="sidenav-second-level collapse <?php if( $collapse=="myaccount" ) echo "show"; ?>" id="myaccountCollapse">
      <li <?php if( $active_opt=="myaccount-edit" ) echo "class='active'"; ?>>
        <a href="<?php echo $abs_path."/"; ?>account">Modificar información</a>
      </li>
    </ul>
  </li>
  <?php } ?>
  <?php if( userAccess()["users"]==1 ) { ?>
    <li class="nav-item <?php if( $active_menu=="customer_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Usuarios">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="customer_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#customerCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-users"></i>
        <span class="nav-link-text">
          Usuarios</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="customer" ) echo "show"; ?>" id="customerCollapse">
        <li <?php if( $active_opt=="customer-view" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers">Lista de Usuarios</a>
        </li>
        <li <?php if( $active_opt=="customer-create" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers-create">Agregar Usuario</a>
        </li>
        <li <?php if( $active_opt=="customer-deleted" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers-deleted">Usuarios Eliminados</a>
        </li>
      </ul>
    </li>
  <?php } ?>
</ul>