<div class="banner"><?php echo $this->bannerprincipal; ?></div>
<a id="a" name="a"></a>
<div class="container-fluid pestanas-cont">
    <div class="container">
        <div class="row pestanas">
            <div class="col-lg-4 align-self-center filtro">
                <div class="row text-center">
                    <div class="col-lg-6 filtrar d-none">
                        <i class="fas fa-filter"></i> Filtrar por categoría
                    </div>
                    <div class="col-lg-12 col-sm-12  boton-filtro">

                        <div id="menu" class="btn-productos btn no_cel">
                            <ul>
                                <li><a>Ver categorías</a>
                                    <ul>
                                        <?php foreach ($this->categorias as $key => $categoria) { ?>
                                            <li><a href="?categoria=<?php echo $categoria->categorias_id; ?>#a"><?php echo $categoria->categorias_nombre; ?></a>
                                                <?php if (count($categoria->hijos) > 0) { ?>
                                                    <ul>
                                                        <?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
                                                            <li><a href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>#a"><?php echo $subcategoria->categorias_nombre; ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>

                        </div>



                        <div class="dropdown solo_cel">
                            <button class="btn btn-productos dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ver categorías
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($this->categorias as $key => $categoria) { ?>
                                    <a class="dropdown-item dropdown-categoria" href="?categoria=<?php echo $categoria->categorias_id; ?>#a"><?php echo $categoria->categorias_nombre; ?></a>
                                    <?php if (count($categoria->hijos) > 0) { ?>
                                        <?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
                                            <a class="dropdown-item dropdown-categoria2" href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>#a"><?php echo $subcategoria->categorias_nombre; ?></a>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    <div class="dropdown-divider"></div>
                                <?php } ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-center ciudad d-none">
                Ciudad de Envío: Bogotá
            </div>
            <div class="col-lg-3 col-sm-12 buscar">
                <form method="post" action="/page/index/#a" class="row">
                    <div class="col-lg-9 col-md-8 buscar-text">
                        <input type="input" class="form-control" name="buscar" id="buscar" value="<?php echo $_POST['buscar']; ?>" placeholder="Buscar">
                    </div>
                    <div class="col-lg-2 col-md-4 text-right text-end buscar-ico" onclick="$('#buscar_enviar').click();">
                        <i class="fas fa-search" align="right"></i>
                    </div>
                    <div class="d-none"><button type="submit" id="buscar_enviar"></button></div>
                </form>
            </div>
            <div class="col-lg-5 text-center text-lg-right">
                <div class="nombre">
                    <i class="fas fa-user" style="margin-right: 5px;"></i> Bienvenido, <?php echo $this->socio->socio_nombre; ?> <a href="/page/login/logout" class="btn btn-sm btn-cafe margen_salir">Salir</a>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <div align="center" class="col-lg-12">
            <br>
            <ul class="pagination justify-content-center">
                <?php
                $url = $this->route;
                $max = $this->page + 6;
                $min = $this->page - 6;
                if ($this->page > 1) {
                    $max = $this->page + 3;
                    $min = $this->page - 3;
                }
                if ($this->page == 2) {
                    $max = $this->page + 5;
                }
                if ($this->page == 3) {
                    $max = $this->page + 4;
                }
                if ($this->totalpages > 1) {
                    for ($i = 1; $i <= $this->totalpages; $i++) {
                        if ($this->page == $i) {
                            echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                        } else {
                            if ($i >= $min and $i <= $max) {
                                echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $_GET["categoria"] . '#a">' . $i . '</a></li>  ';
                            }
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <?php echo $this->productos; ?>
    </div>
    <div class="row">
        <div align="center" class="col-lg-12">
            <br>
            <ul class="pagination justify-content-center">
                <?php
                $url = $this->route;
                if ($this->totalpages > 1) {
                    for ($i = 1; $i <= $this->totalpages; $i++) {
                        if ($this->page == $i) {
                            echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                        } else {
                            if ($i >= $min and $i <= $max) {
                                echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $_GET["categoria"] . '#a">' . $i . '</a></li>  ';
                            }
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>