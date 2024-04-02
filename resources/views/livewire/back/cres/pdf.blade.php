<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Détails du CRE
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   
    <style>
        

        * {
            margin: 0 auto;
            padding: 0 auto;
            user-select: none;
        }

        body {
            padding: 20px;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #dcdcdc;
        }

        .wrapper-invoice {
            display: flex;
            justify-content: center;
        }

        .wrapper-invoice .invoice {
            height: auto;
            background: #fff;
            padding: 5vh;
            margin-top: 5vh;
            max-width: 110vh;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #dcdcdc;
        }

        .wrapper-invoice .invoice .invoice-information {
            float: right;
            margin-right: 20px;
        }

        /* invoice-confidentialite  center*/
        .wrapper-invoice .invoice .invoice-confidentialite {
            text-align: center;
        }

        .wrapper-invoice .invoice .invoice-logo-brand img {
            max-width: 200px;
            width: 200%;
            object-fit: fill;
        }

        .wrapper-invoice .invoice .invoice-head {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 8vh;
        }

        .wrapper-invoice .invoice .invoice-head .head {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .wrapper-invoice .invoice .invoice-head .client-info p {
            font-size: 2vh;
            color: rgb(19, 18, 18);
            text-align: center;
        }

        .wrapper-invoice .invoice .invoice-body {
            font-size: 2vh;
            border-bottom: 1px solid #dcdcdc;
            padding: 1vh;
            background-color: #fff;
        }

        .wrapper-invoice .invoice .invoice-body {
            margin-top: 3rem;
        }

        .wrapper-invoice .invoice .invoice-body p {
            margin-bottom: 1rem;
        }

        .wrapper-invoice .invoice p {
            font-size: 1.7vh;
        }

        .copyright {
            margin-top: 2rem;
            text-align: center;
        }

        .copyright p {
            color: gray;
            font-size: 1.8vh;
        }

        @media print {

            .copyright {
                display: none;
            }
        }


        .flex-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .item {
            margin: auto;
        }
    </style>
</head>

<body>
    <section class="wrapper-invoice">
        <!-- switch mode rtl by adding class rtl on invoice class -->
        <div class="invoice">

            <div class="flex-container">
                <div class="item"> <!-- logo brand invoice -->
                    <div class="invoice-logo-brand">
                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="" />
                    </div>
                </div>
                <div class="item">
                    <div class="invoice-confidentialite">
                        <p><b>CONFIDENTIEL</b></p>
                    </div>
                </div>
                <div class="item">
                    <div class="invoice-information">
                        <p><b>Réf</b> : {{ $candidate->cre_ref ?? '---' }}</p>
                        <p><b>Auteur</b>: {{ $candidate->auteur->trigramme ?? '' }}</p>
                        <p><b>Date</b> :
                            {{ $candidate->cre_created_at ? \Carbon\Carbon::parse($candidate->cre_created_at)->format('d-m-Y') : '--' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- invoice head -->
            <div class="invoice-head">
                <div class="head client-info">
                    <p>COMPTE RENDU D'ENTRETIEN DE
                        {{ $candidate->civ->name ?? '---' }}. {{ $candidate->first_name ?? '---' }}
                        {{ $candidate->last_name ?? '---' }}</p>
                    <p>POSTE : {{ $candidate->position->name }}</p>

                </div>

            </div>
            <!-- invoice body-->
            <div class="invoice-body">

                <ol>
                    @forelse ($cres as $cre)
                    <li>
                        <p class=" ">{{ $cre->question }} :</p>
                        <p class="">{{ $cre->response }}</p>
                    </li>

                    @empty
                    <div class="">
                        Aucun compte rendu d'entretien n'est disponible pour le moment.
                    </div>
                    @endforelse
                </ol>

            </div>
            <!-- invoice footer -->
            <div class="copyright">
                <p>-----+-----+-----+-----</p>
            </div>
        </div>
    </section>

</body>

</html>
