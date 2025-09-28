
<form method="POST" onsubmit="return validateCategoryForm()" >
    <label for="choice1">Choose a Category</label>
    <select  name="categorySelection" size="3">
        <option value="choice1" > Photography </option>
        <option value="choice2"> Coding </option>
        <option value="choice3"> Basketball </option>
    </select><br><br>
    <input type="Submit" value="submit">
</form>
<script>
    function validateCategoryForm() {
        var categorySelect = document.getElementsByName('categorySelection')[0];
        if (categorySelect.selectedIndex === -1) {
            alert('Please select a category before submitting!');
            return false;
        }
        return true;
    }
</script>

<?php
$photograpghy = [
        [
                'Question' => "what is aperture",
                'Answer' => [
                        "the amount of light let into the lens",
                        "for symetry",
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

$coding = [
        [
                'Question' => "what is the difference between hashMap and hashSet",
                'Answer' => [
                        "HashMap is 2D while hashSet is 1D",
                        "HashSet stores keys and values. while HashMap does not",
                        "HashMap stores keys and values. while HashSet does not",
                        "hashMaps hold Strings while HashSets hold Arrays"
                ],
                'correctAnswer' => ["HashMap is 2D while hashSet is 1D","HashMap stores keys and values. while HashSet does not"]
        ],
        [
                'Question' => "Which is better Java or JS",
                'Answer' => [
                        "JS because java has too much boilerplate",
                        "they cannot be compared",
                        "JS",
                        "without a doubt Java"
                ],
                'correctAnswer' => "without a doubt Java"
        ]
];

$basketball = [
        [
                'Question' => "what is a clean pass called",
                'Answer' => ["dime","good pass","key","quarter"],
                'correctAnswer' => ["dime"]
        ],
        [
                'Question' => "what is a missed shot called",
                'Answer' => [
                        "brick",
                        "air ball",
                        "devastation",
                        "block"
                ],
                'correctAnswer' => ["brick","air ball"]
        ]
];

$categorySelected = $_POST["categorySelection"] ?? null;

function displayForm($currentQuestion, $category, $highlightCorrect = false, $userAnswer = []) {
    echo "<h1>" . $currentQuestion['Question'] . "</h1>";
    echo "<form method='POST' action='' onsubmit='return validateAnswerForm()' >";

    // Normalize correctAnswer to array
    $correctAnswers = is_array($currentQuestion['correctAnswer'])
            ? $currentQuestion['correctAnswer']
            : [$currentQuestion['correctAnswer']];

    echo "<input type='hidden' name='realAnswer' value='" . htmlspecialchars(json_encode($correctAnswers)) . "'>";
    echo "<input type='hidden' name='questionData' value='" . htmlspecialchars(json_encode($currentQuestion)) . "'>";
    echo "<input type='hidden' name='categorySelection' value='" . $category . "'>";

    if (!is_array($userAnswer)) {
        $userAnswer = [$userAnswer];
    }

    // Pick radio or checkbox
    $inputType = count($correctAnswers) > 1 ? "checkbox" : "radio";
    $nameAttr = $inputType === "checkbox" ? "possibleAnswer[]" : "possibleAnswer";

    foreach($currentQuestion['Answer'] as $answer) {
        $style = "";
        $checked = "";
        $disabled = "";

        if($highlightCorrect) {
            $disabled = "disabled";
            if(in_array($answer, $correctAnswers)) {
                $style = "style='color: green; font-weight: bold;'";
            } elseif(in_array($answer, $userAnswer)) {
                $style = "style='color: red; font-weight: bold;'";
            }
            if(in_array($answer, $userAnswer)) {
                $checked = "checked";
            }
        }

        echo "<label>";
        echo "<input type='$inputType' name='$nameAttr' value='$answer' $checked $disabled> <span $style>$answer</span>";
        echo "</label><br>";
    }

    if(!$highlightCorrect) {
        echo "<input type='submit' value='Submit Answer'>";
    }
    echo "</form>";

    if(!$highlightCorrect) {
        echo "<script>
        function validateAnswerForm() {
            var inputs = document.getElementsByName('$nameAttr');
            var checked = false;
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].checked) {
                    checked = true;
                }
            }
            if (!checked) {
                alert('Please select at least one answer before submitting!');
                return false;
            }
            return true;
        }
        </script>";
    }
}

// Show a question only AFTER category selection
if ($categorySelected && !isset($_POST['possibleAnswer']) && !isset($_POST['possibleAnswer'])) {
    $currentQuestion = null;

    if ($categorySelected == "choice1") {
        $currentQuestion = $photograpghy[rand(0, 1)];
    } elseif ($categorySelected == "choice2") {
        $currentQuestion = $coding[rand(0, 1)];
    } elseif ($categorySelected == "choice3") {
        $currentQuestion = $basketball[rand(0, 1)];
    }

    if ($currentQuestion) {
        displayForm($currentQuestion, $categorySelected);
    }
}

// After answer submission
if(isset($_POST["realAnswer"]) && isset($_POST["possibleAnswer"])) {
    $realAnswer = json_decode($_POST["realAnswer"], true);
    $quizAnswer = $_POST["possibleAnswer"];
    if (!is_array($quizAnswer)) {
        $quizAnswer = [$quizAnswer];
    }
    $questionData = json_decode($_POST["questionData"], true);
    $category = $_POST["categorySelection"];

    sort($realAnswer);
    sort($quizAnswer);

    if ($quizAnswer === $realAnswer) {
        echo "<h2 style='color: green;'>Correct!</h2>";
    } else {
        echo "<h2 style='color: red;'>Wrong!</h2>";
    }

    displayForm($questionData, $category, true, $quizAnswer);
}
?>

