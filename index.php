<?php

    require_once 'app/config/config.php';
    require_once 'app/modules/hg-api.php';

    $hg = new HG_API(HG_API_KEY);

    $currencies = $hg->currencies();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Quotations</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="10">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">

    <title>Cotação Dólar</title>
  </head>
  <body>

    <div class="container">
          <div class="row">
              <div class="col-12">
                  <h1>Currency Quotations</h1>
                  <h3>Source: BRL</h3>
                    <?php if($hg->is_error() == false): ?>
                        <?php
                            $arrObject = new ArrayObject($currencies);
                            $arrayIterator = $arrObject->getIterator();

                            echo("<table class='table table-bordered table-hover table-light'>");
                                $arrayIterator->next();

                                echo("<thead class='thead-light'>");
                                    foreach ($arrayIterator->current() as $key => $value) {
                                        echo("<th>");
                                            echo(ucfirst($key));
                                        echo("</th>");
                                    }
                                echo("</thead>");

                                echo("<tbody class='tbody-light'>");
                                    while( $arrayIterator->valid() )
                                    {
                                        
                                        if($arrayIterator->current()['variation'] > 0) 
                                            $variation = "<a class='text-primary'>▲ </a>";
                                        elseif($arrayIterator->current()['variation'] < 0)
                                            $variation = "<a class='text-danger'>▼ </a>";
                                        else
                                          $variation = "<a class='text-info'>■ </a>";
                                        
                                        echo("<tr>");
                                            echo "<td>" . $variation . $arrayIterator->current()['name'] . "</td>" .
                                            "<td>" . $arrayIterator->current()['buy'] . "</td>" .
                                            "<td>" . $arrayIterator->current()['sell'] . "</td>" .
                                            "<td>" . $arrayIterator->current()['variation'] . "</td>";  
                                            $arrayIterator->next();  
                                        echo("</tr>");
                                    }
                                  echo("</thead>");
                                
                            echo("</table>");
                        ?>
                      </p>
                    <?php else: ?>
                      <p><span class="badge badge-pill badge-danger">Serviço indisponível</span></p>
                    <?php endif; ?>
              </div>    
          </div>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>