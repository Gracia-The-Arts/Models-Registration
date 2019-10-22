<?php
/**
 * This script handles the form processing
 *
 * PHP version 7.2
 *
 * @category Registration
 * @package  Registration
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  GPL https://opensource.org/licenses/gpl-license
 * @version  GIT: 1.0
 * @link     https://stbensonimoh.com
 */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// echo json_encode($_POST);
require './bootstrap.php';

// capture the data coming from the form
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['full_phone'];
$address = $_POST['address'];
$rawDOB = $_POST['dateOfBirth'];
$dateOfBirth = date("Y-m-d", strtotime($rawDOB));
$occupation = $_POST['occupation'];
$gender = $_POST['gender'];
$linkedin = $_POST['linkedin'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];

$details = [
    "firstName"                     =>  $firstName,
    "middleName"                    =>  $middleName,
    "lastName"                      =>  $lastName,
    "email"                         =>  $email,
    "phone"                         =>  $phone,
    "address"                       =>  $address,
    "dateOfBirth"                   =>  $dateOfBirth,
    "occupation"                    =>  $occupation,
    "gender"                        =>  $gender,
    "linkedin"                      =>  $linkedin,
    "twitter"                       =>  $twitter,
    "instagram"                     =>  $instagram,
    "facebook"                      =>  $facebook,
    "twitter"                       =>  $twitter
];

// Amount to be collected from the user
$amount = 5000;

if ($db->insertUser("modelsreg", $details)) {
    // Run CURL
    $curl = curl_init();
    $redirect_url = "https://graciathearts.com/models/registration/scripts/verify.php";

    curl_setopt_array(
        $curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(
                [
                'amount'    =>  $amount,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_firstname' => $firstName,
                'customer_lastname' => $lastName,
                'custom_title' => 'Models Registration',
                'custom_logo' => 'https://graciathearts.com/email/logo.png',
                'custom_description' => 'Registration for Gracia The Arts Models.',
                'currency' => 'NGN',
                'txref' =>  $transactionRef,
                'PBFPubKey' => $raveKey,
                'redirect_url' => $redirect_url
                ]
            ),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $transaction = json_decode($response);

    echo $transaction->data->link;
}
