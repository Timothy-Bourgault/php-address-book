<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/address_book.php";

    session_start();

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    // $app->register(new Silex\Provider\TwigServiceProvider(), array(
    //     'twig.path' => __DIR__.'/../views'
    // ));

    $app->get("/", function() {

        $output = "";

        $all_contacts = Contact::getAll();

        if (!empty($all_contacts)) {
            $output .= "
                <h1>Contact Book</h1>
                <p>Here are all your Contacts:</p>
                ";

            foreach ($all_contacts as $contact) {
                $output .= "<ul><li>" . $contact->getName() . "</li>
                <li>" . $contact->getPhone() . "</li>
                <li>" . $contact->getAddress() . "</li></ul>";

            }
        }

        $output .= "
            <h2>Please Enter A new Contact!</h2>
            <form action='/contacts' method='post'>
                <label for='name'>Name: </label>
                <input id='name' name='name' type='text'>
                <br />
                <br />
                <label for='phone'>Phone: </label>
                <input id='phone' name='phone' type='number'>
                <br />
                <br />
                <label for='address'>Address: </label>
                <input id='address' name='address' type='text'>
                <br />
                <br />
                <button type='submit'>Add Contact</button>
            </form>
        ";

        $output .= "
            <form action='/delete_contacts' method='post'>
                <button type='submit'>Clear Contact Book</button>
            </form>
        ";

        return $output;
    });

    $app->post("/contacts", function() {
        $contact = new Contact($_POST['name'], $_POST['phone'], $_POST['address']);
        $contact->save();
        return "
            <h1>You have added a contacts to your contact book!</h1>
            <p>" . $contact->getName() . "</p>
            <p>" . $contact->getPhone() . "</p>
            <p>" . $contact->getAddress() . "</p>
            <p><a href='/'>View your Contact Book!</a></p>
        ";
    });

    $app->post("/delete_contacts", function() {

        Contact::deleteAll();

        return "
            <h1>Contact Book Cleared!</h1>
            <p><a href='/'>Start New Contact Book</a></p>
        ";
    });

    return $app;

?>
