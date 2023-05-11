<!DOCTYPE html>
<html>
    
<?php
    // Creamos la Variable $url donde se guardara la API solicitada
    $url = "https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25&lang=es";

    //Creamos una nueva variable la cual sera la encargada de recibir la palabra que se quiera buscar
    $termino = "";
    // Preguntamos si dentro de la variable encontramos algo y posteriormente verificamos su longitud 
    //en caso de que en la variable contenga algo
    if (isset ($_GET['termino'])) {
        $longitudTermino = strlen($_GET['termino']);
        if ($longitudTermino <= 100) {
            $termino = "&q=".$_GET['termino']; //Si es menor de 100 caracteres
        }else {
            echo '<script>alert("Error, Numero de caracteres mayor a 100")</script>'; // en caso de que contenga mas de 100 caracteres
            $termino = ""; //Limpiamos la variable
        }
    }
    
    //La Categoria se usuara para la lista(DropDown)
    if (isset ($_GET['Categoria'])) {
        $Categoria = "&category=".$_GET['Categoria'];
    }else{
        $Categoria = "";
    }
    //Concardenamos en la url el termino y la categoria en caso de que se hayan solicitado
    $url = $url. $termino. $Categoria;
    //Pasamos la API a formato JSON para ser consumida
    $json = file_get_contents($url); 
    $datos = json_decode($json, true);

?>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Prueba Tecnica</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    
    <body class="bg-light">
            <div class="container-fluid ">
                <div class="container">
                    <nav class="navbar navbar-expand-lg ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#"> PRUEBA PHP </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <form class="d-flex p-2"  method="get" action="" >

                                    <select class="form-select" name="Categoria" p>
                                        <option disabled selected>Selecciona categoria</option>
                                        <!-- Se colocan los siguientes if para que la categoria seleccionada sea mostrada aun despues de ser buscada -->
                                        <option value="science" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'science') { echo 'selected'; } ?> >Ciencia</option>
                                        <option value="education" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'education') { echo 'selected'; } ?> >Educación</option>
                                        <option value="people" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'people') { echo 'selected'; } ?> >Personas</option>
                                        <option value="feelings" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'feelings') { echo 'selected'; } ?> >Sentimientos</option>
                                        <option value="computer" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'computer') { echo 'selected'; } ?> >Computadora</option>
                                        <option value="buildings" <?php if ( isset ($_GET['Categoria']) AND $_GET['Categoria'] == 'buildings') { echo 'selected'; } ?> >Edificios</option>
                                    </select>

                                    <?php 
                                        if ($termino != '') { 
                                            //Si se ah buscado alguna palabra entra aqui
                                            ?> 
                                                <input value="<?php echo $_GET['termino'] ?>" class="form-control me-2" type="text" name="termino" placeholder="Buscar" aria-label="Search" maxlength="100">
                                            <?php 
                                        }else{
                                            //Si no se ah buscado ninguna palabra entra aqui
                                            ?>
                                                <input  class="form-control me-2" type="text" name="termino" placeholder="Buscar" aria-label="Search" maxlength="100">
                                                <?php 
                                        }
                                    ?>
                                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="container text-center bg-light">
                <div class="row row-cols-3">
                <?php
                    //Recorremos la variable $datos para poder sacar cada uno de los datos de la imagen
                    for ($i=0; $i < count($datos["hits"]) ; $i++) { 
                        $tags = $datos["hits"][$i]["tags"];
                        $likes = $datos["hits"][$i]["likes"];
                        $views = $datos["hits"][$i]["views"];
                        $image = $datos["hits"][$i]["webformatURL"];
                        ?>
                        <div class="col album py-3">
                            <div class="container">
                                <div class="row row-cols-1 g-3">
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img class="bd-placeholder-img card-img-top" id= "imagenPre" width="100%" height="225" src ="<?php echo $image; ?>" onclick="previewImage(this)" data-image="<?php echo $image; ?>" ></img>
                                    <div class="card-body">
                                        <p class="card-text">La mejor tienda de Tecnologia que puedes encontrar.</p>
                                        <p class="card-text"><?php echo $tags; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <input type="button" class="btn btn-sm btn-outline-secondary" value="Views">
                                                <button type="" class="btn btn-sm btn-outline-primary ">
                                                <?php echo $views; ?>
                                            </button>
                                                
                                            </div>
                                            <button type="" class="btn btn-sm btn-outline-primary "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 15 15">
                                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                </svg>
                                                <?php echo $likes; ?>
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                </div>
            </div>


            <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                    <img src="" id="previewImage" class="img-fluid">
                    </div>
                </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

            <script>
                function previewImage(element) {
                var image = element.getAttribute('data-image');
                var previewImageElement = document.getElementById('previewImage');
                previewImageElement.setAttribute('src', image);

                var modal = new bootstrap.Modal(document.getElementById('previewModal'));
                modal.show();
                }
            </script>
    </body>
</html>