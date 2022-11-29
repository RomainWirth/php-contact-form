<?php 
    // Code de première isntance avec initialisation des données
    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";

    // Code de la deuxième instance
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = verifyInput($_POST['firstname']);
        $name = verifyInput($_POST['name']);
        $email = verifyInput($_POST['email']);
        $phone = verifyInput($_POST['phone']);
        $message = verifyInput($_POST['message']);

        if(empty($firstname)) {
            $firstnameError = "Merci de m'indiquer ton prénom";
        }
        if (empty($name)) {
            $nameError = "Merci de m'indiquer ton nom";
        }
        if(empty($message)) {
            $messageError = "Votre message est vide, merci de remplir ce champ";
        }
        if(!isEmail($email)) {
            $emailError = "Merci d'indiquer une adresse email valide";
        }
        if(!isPhone($phone)) {
            $phoneError = "Merci d'indiquer un numéro de téléphone valide (chiffres et espaces uniquement)";
        }
    }

    function isPhone($var) {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var) {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var) {
        $var = trim($var); // enlève tous les espaces
        $var = stripslashes($var); // enlève tous les '\'
        $var = htmlspecialchars($var); // permet de se protéger contre la faille XSS (injection de script dans le document par l'utilisateur)
        return $var;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript"
        src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=5uY6sLrkcp90UUJjqh9rRTAhx2DcJh6BdXhPLdjjipDB1rJVvKdRWpSNFYxpXNP0UhCwSEIat9ByMrXk8k_2JuCNxMFFwwurlcVu2LQzDhwtU8o2OLzBImUJBSPvnGU41UQ7ic1CKPA3BJzMBCGLgN79wlM6XoqtCL6w44065927cpuRz83YOrAg4kY_4t-5M2X87sLxJMzRKnV6AjPVa9vidtUjeatl_3BTELV8C2eZBZsolgzHXyFt_uVi3uNcRBwvKMOijRq0ofwn_klTiswySD0p8qvceWjmwszVuEJEQglklYNMn-2MikJzvvRBRH3Ari8OfdbWUGRBCphOWhMF1YnnhiVbjrTIci6Yo4pI1Zd-DwxUg0mEfepTk2BI_mnXUO6D8ftdDC6hrKaKzfZ7VcuIBhqFCsRyqfPv9JbNckXmz6jF55znX2UOSS66oc9NH8pu3enrF_utmbrCfP5jmjCQHdyU_alsdmM2I2GnN9TdJ4jtLsS3_PLn9m6gOF9Z2ValoT4960ft-7WoY_sLH3xrzY7LUlWDa-Z022LO3I_wrCmuwE1uVnLEuARVnJ75Nfbmf2Z0VBGXydvwgV3OIQwwF4XRZo0OpkPRF7ndXXgs0J26RLbV9rsYOHNl474abjVcKYcwwrgtcra5jzyH6B0_NCkXynebQaJy9lHLWmCqngKyUT8P-Ah8TPim3oUnLTcMSKDGhkIbuukPsmRpHiNowMnr9lT_GxdxhVb2BenUFegDn77Kdz2ugjnV_R_8eYHx1C1HHnpjJi7P_g"
        charset="UTF-8"></script>
    <link rel="stylesheet" crossorigin="anonymous"
        href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9hdHQtYy51ZGVteWNkbi5jb20vMjAyMS0xMi0xNF8xNS00MC0wMC1hNTg3MWViMTRjMmVlODRlZDc4Y2FmMDZlN2QyOTY3MS9vcmlnaW5hbC5odG1sP3Jlc3BvbnNlLWNvbnRlbnQtZGlzcG9zaXRpb249YXR0YWNobWVudCUzYiUyMGZpbGVuYW1lJTNkaW5kZXguaHRtbCZFeHBpcmVzPTE2NjkxNDA3ODcmU2lnbmF0dXJlPUk1Sn5vTUZSMWY5eVNSMnhIRTlYcXNTY0hmckxHTy1FNzFXSW1pWFNBZDhjUEZCZ2FFenFlQjZncTFET1F3SFVMdk8zbnVRRmcyfnZSQ35JSWZ2NzJNTXY4eXNQMTl0bFlkSTA2eUc1NjhzVlZ3bERKS0FRUVNRZXNZVW1OQzZMSkJOYkFxTUxGbHRVelhsazViMXV0TDVKR1BtTU5vbTBCbTUtMFVVS29jWTUwcWx3d3VuVFRnb2xrbGFuakV5WXN3Q2dJQUsxNWVsc1lEbDA1Wlo0c0hNejdtMEs4OWpPNFJocnNTZWdtcU9MRjVoaEptV3RoRGU2WG5RaXVwQkhGTUp1Z002dHVaNWtyRUZZcUxDSElDcFVTeDZNemZzQWEyTU1zQ0liS0JWNE5PLUtXZ3RaY2d4ckVITXVmNVhNUEV6TXptbU1rZWRzfjdwZjdieG1-d19fJktleS1QYWlyLUlkPUFQS0FJVEpWNzdXUzVaVDcyNjJB" />

    <!-- jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- styles -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">

    <title>Formulaire de contact</title>
</head>
<body>
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>Contactez-moi</h2>
        </div>
        <form 
            id="contact-form" 
            method="post" 
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
            role="form"
        >
            <div class="row">
                <div class="col-lg-6">
                    <label for="firstname" class="form-label">Prénom <span class="blue">*</span></label>
                    <input 
                        id="firstname" 
                        type="text" 
                        name="firstname" 
                        class="form-control" 
                        placeholder="Votre prénom" 
                        value="<?php echo $firstname; ?>"
                    >
                    <p class="comments"><?php echo $firstnameError ?></p>
                </div>
                <div class="col-lg-6">
                    <label for="name" class="form-label">Nom <span class="blue">*</span></label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        placeholder="Votre Nom"
                        value="<?php echo $name; ?>"
                    >
                    <p class="comments"><?php echo $nameError ?></p>
                </div>
                <div class="col-lg-6">
                    <label for="email" class="form-label">Email <span class="blue">*</span></label>
                    <input 
                        id="email" 
                        type="text" 
                        name="email" 
                        class="form-control" 
                        placeholder="Votre Email"
                        value="<?php echo $email; ?>"
                    >
                    <p class="comments"><?php echo $emailError ?></p>
                </div>
                <div class="col-lg-6">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input 
                        id="phone" 
                        type="tel" 
                        name="phone" 
                        class="form-control" 
                        placeholder="Votre Téléphone"
                        value="<?php echo $phone; ?>"
                    >
                    <p class="comments"><?php echo $phoneError ?></p>
                </div>
                <div>
                    <label for="message" class="form-label">Message <span class="blue">*</span></label>
                    <textarea 
                        id="message" 
                        name="message" 
                        class="form-control" 
                        placeholder="Votre Message" 
                        rows="4"
                    >
                        <?php echo $message; ?>
                    </textarea>
                    <p class="comments"><?php echo $messageError ?></p>
                </div>
                <div>
                    <p class="blue"><strong>* Ces informations sont requises.</strong></p>
                </div>
                <div>
                    <input type="submit" class="button1" value="Envoyer">
                </div>    
            </div>
            <p id="thank-you">Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>
        </form>
    </div>
</body>
</html>