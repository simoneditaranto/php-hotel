<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    $is_filtered = $_GET['hotel-parking'];
    $hotel_avg = $_GET['hotel-avg'];

    if($is_filtered)
    {
        $hotel_filtered = [];
        foreach($hotels as $currentHotel) {
            if($currentHotel['parking'] && $currentHotel['vote'] >= $hotel_avg) {
                $hotel_filtered[] = $currentHotel;
            };
        };
        // var_dump($hotel_filtered);
        // test
    } elseif($hotel_avg > 0) {
        $hotel_filtered = [];
        foreach($hotels as $currentHotel) {
            if($currentHotel['vote'] >= $hotel_avg) {
                $hotel_filtered[] = $currentHotel;
            };
        };
    };

?>

<!DOCTYPE html>
<html lang="it">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotels</title>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>

    <body>

        <div class="container p-3 mt-3 border border-primary rounded-3">
            <h1>PHP - Hotel</h1>

            <label for="form">Cerca qui l'hotel che fa al caso tuo:</label>
            <form action="index.php" class="d-flex align-items-center gap-2 p-3 border border-secondary rounded-3">
                <label for="hotel-parking">Parcheggio</label>
                <input type="checkbox" id="hotel-parking" name="hotel-parking" value="true">
                <label for="hotel-avg">Voto:</label>
                <input type="number" name="hotel-avg" id="hotel-avg" min="0" max="5">

                <input type="submit" value="Trova Hotel" class="btn btn-outline-success">
            </form>

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        // ciclo tutto l'array di hotel tramite un foreach
                        foreach($hotels as $currentHotel) {
                            
                           echo "
                                <tr>
                                    <td class=text-primary>$currentHotel[name]</td>                     
                                    <td>$currentHotel[description]</td>
                                ";
                                if($currentHotel['parking']) {
                                    echo "
                                            <td class=text-success>
                                                SI
                                            </td>
                                        ";
                                } else {
                                    echo "
                                            <td class=text-danger>
                                                NO
                                            </td>
                                        ";
                                }
                                    
                               if($currentHotel['vote'] > 3) {
                                echo "
                                        <td class=text-warning
                                        >
                                            $currentHotel[vote]
                                        </td>
                                    ";
                               } else {
                                echo "
                                        <td>
                                            $currentHotel[vote]
                                        </td>
                                    ";
                               };

                                echo "                       
                                    <td>$currentHotel[distance_to_center]</td>
                                </tr>
                            ";

                        };

                    ?>
                </tbody>
            </table>

        </div>

        <div class="container p-3 mt-3 border border-info-subtle rounded-3">
            <h1>Hotel filtrati</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        if($is_filtered || $hotel_avg > 0) {

                            foreach($hotel_filtered as $currentHotel) {
                                echo "
                                <tr>                         
                                ";
    
                                foreach($currentHotel as $currentProperty => $value) {
                                    if($currentProperty == 'parking') {
                                        if($value) {
                                            $value = "SI";
                                        } else {
                                            $value = "NO ";
                                        };
                                    };
                                    echo "
                                    <td>
                                        $value
                                    </td>";
                                };
    
                                echo "
                                </tr>
                                ";
    
                            };
                        } else {
                            echo "
                                <span class=text-danger>
                                Nessun ricerca effettuata
                                </span>
                            ";
                        }

                        $hotel_filtered = [];
                        // ciclo tutto l'array di hotel tramite un foreach

                    ?>

                </tbody>
            </table>

        </div>
        

        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>

</html>