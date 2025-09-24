
<form method="POST" >
    <label for="choice1">Choose a Category</label>
    <select  name="categorySelection" size="3">
        <option value="choice1"> Photography </option>
        <option value="choice2"> Coding </option>
        <option value="choice3"> Basketball </option>
        </select><br><br>
    <input type="Submit" value="submit">
</form>




<?php

/* CATEGORIES
 *   Photography
 *      - what is aperture
 *          answer( the amount of light let into the lens)
 *      - what is shutter speed
 *          answer(how fast the shutter will shut, for example faster shutter speed can capture faster moving objects)
 *   Coding
 *      - what is the difference between hashMap and hashSet
 *          answer( hashmap has a key and value, hashset only has a value)
 *      - what is better JS or Java
 *          answer( without doubt Java.)
 *
 * */
$photograpghy = [
    [
        'Question' => "what is aperture",
        'Answer' => [
                    "the amount of light let into the lens", "
                    for symetry",
                    "to block glare",
                    "too absorb sun rays"
                    ],

        'correctAnswer' => "the amount of light let into the lens"
        ],
    [
        'Question' => "what is shutter speed",
        'Answer' => [
                    "speed it takes you to take a picture",
                    "how fast the shutter will shut",
                    "how long the shutter will be shut",
                    "how fast you can blink"
                ],

        'correctAnswer' => "how long the shutter will be shut"
    ]
];

$answer = isset($_POST["categorySelection"]) ; //getting the data from form: coding ( in this case only 1)
if ($answer == "choice1") {
    $currentQuestion = $photograpghy[rand(0, 1)];


    echo "<h1>" . $currentQuestion['Question'] . "</h1>";
    echo "<form method='POST' action=''>";
    $possibleAnswer1 = $currentQuestion['Answer'][0];
    echo "<label><input type='radio' name='possibleAnswer' value='" . $possibleAnswer1 . "'>" . $possibleAnswer1 . "</label><br>";
    $possibleAnswer2 = $currentQuestion['Answer'][1];
    echo "<label><input type='radio' name='possibleAnswer' value='" . $possibleAnswer2 . "'>" . $possibleAnswer2 . "</label> <br>";
    $possibleAnswer3 = $currentQuestion['Answer'][2];
    echo "<label><input type='radio' name='possibleAnswer' value='" . $possibleAnswer3 . "'>" . $possibleAnswer3 . "</label><br>";
    $possibleAnswer4 = $currentQuestion['Answer'][3];
    echo "<label><input type='radio' name='possibleAnswer' value='" . $possibleAnswer4 . "'>" . $possibleAnswer4 . "</label><br>";
    echo "<input type='submit' value='Submit Answer'>";
    echo "</form>";


$realAnswer = $currentQuestion['correctAnswer'];
}
$quizAnswer = isset($_POST["possibleAnswer"]) ? $_POST["possibleAnswer"] : "";
if($quizAnswer == $realAnswer) {}
    echo "<h1>" . $quizAnswer . "</h1>";



/*
 * <form method="POST">
    <label for="answerSelection"></label>
    <input type='text' name="answerSelection" id="answerSelection">
    <input type="Submit" value="Submit Answer">
</form>
*/

