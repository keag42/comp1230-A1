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


$quizArray= [
    'Categorey 1' => [
        [
        'Questions' => "Question here",
        'Answers' => "Answer here",
        'correctAnswers' => "Correct Answer here"
        ]
    ]
];


echo '<form action="index.php">';
echo  '<label for="action1">Choose a Category</label>';
echo      '<select id="cars" name="coding" size="3">';
echo            '<option value="choice1"> Category 1 </option>';
echo            '<option value="choice2"> Category 2 </option>';
echo            '<option value="choice3"> Category 3 </option>';
echo      '</select><br><br>';
echo  '<input type="submit">';
echo '</form>';
