<?php 
require_once 'core/init.php';

$user = new User();
$db = DB::getInstance();

if(!$user->isLoggedIn()){
	Redirect::to('register.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $items_to_validate = array(
            'category' => array(
                'required' => true
            ),
            'q1' => array(
               'required' => true     
            ),
            'q2' => array(
                'required' => true
            ),
            'q3' => array(
                'required' => true
            ),
            'q4' => array(
                'required' => true
            ),
            'q5' => array(
                'required' => true
            )
        );

        array_push($items_to_validate, Category::get_validation_arr());


        $validation = $validate->check($_POST, $items_to_validate);

        if ($validation->passed()) {
            try {
                    
                $db->insert('opinions', array(
                    'user_id' => $user->data()->id,
                    'category' => Category::get_path(),
                    'opinion' => Input::get('opinion-field'),
                    'q1'=> Input::get('q1'),
                    'q2'=> Input::get('q2'),
                    'q3'=> Input::get('q3'),
                    'q4'=> Input::get('q4'),
                    'q4'=> Input::get('q4'),
                    'q5'=> Input::get('q5'),
                    'post_date' => date('Y-m-d H:i:s')

                ));

                Session::flash('home', 'Your opinion was posted.');
                Redirect::to('index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }

        }else{
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}  

?>


 <form action="" method="post">
    <div class="form-item-select">
        <label for="category">Изберете категория</label>
        <select name="category" id="category">
            <option value="0">Моля изберете</option>
           <?php 
               $main_categories = $db->get_all('main_categories')->results();
               foreach ($main_categories as $category) {
                echo "<option value='{$category->id}'>{$category->main_category}</option>";
               }
            ?>
        </select>
    </div>

    <div class="form-item-select sub" style="display:none">
        <label for="subcategory-1"></label>
        <select name="subcategory-1" id="subcategory-1">
            <option value="0">Моля изберете</option>
        </select>
    </div>

    <div class="form-item-select sub"  style="display:none">
        <label for="subcategory-2"></label>
        <select name="subcategory-2" id="subcategory-2">
            <option value="0">Моля изберете</option>
        </select>
    </div>

    <div class="form-item-select sub"  style="display:none">
        <label for="subcategory-3"></label>
        <select name="subcategory-3" id="subcategory-3">
            <option value="0">Моля изберете</option>
        </select>
    </div>

    <div class="opinion-field-wrapper">
        <label for="opinion-field">Мнението Ви</label>
        <textarea name="opinion-field" id="opinion-field"></textarea>
    </div>

    
    <div class="questions-section clearfix">
        <div class="question-wrapper">
            <p>Доволни ли сте от продукта?</p>
            <div class="rating_stars_wrapper">
                <input class="star" type="radio" name="q1" value="1"/>
                <input class="star" type="radio" name="q1" value="2"/>
                <input class="star" type="radio" name="q1" value="3"/>
                <input class="star" type="radio" name="q1" value="4"/>
                <input class="star" type="radio" name="q1" value="5"/>
                
            </div>
        </div>

        <div class="question-wrapper">
            <p>Колко точно стедоволен от продуктаааа?</p>
            <div class="rating_stars_wrapper">
                <input class="star" type="radio" name="q2" value="1"/>
                <input class="star" type="radio" name="q2" value="2"/>
                <input class="star" type="radio" name="q2" value="3"/>
                <input class="star" type="radio" name="q2" value="4"/>
                <input class="star" type="radio" name="q2" value="5"/>
            </div>
        </div>
    
        <div class="question-wrapper">
            <p>Колко точно стедоволен от продуктаааа?</p>
            <div class="rating_stars_wrapper">
                <input class="star" type="radio" name="q3" value="1"/>
                <input class="star" type="radio" name="q3" value="2"/>
                <input class="star" type="radio" name="q3" value="3"/>
                <input class="star" type="radio" name="q3" value="4"/>
                <input class="star" type="radio" name="q3" value="5"/>
            </div>
        </div>     

        <div class="question-wrapper">
            <p>Колко точно стедоволен от продуктаааа?</p>
            <div class="rating_stars_wrapper">
                <input class="star" type="radio" name="q4" value="1"/>
                <input class="star" type="radio" name="q4" value="2"/>
                <input class="star" type="radio" name="q4" value="3"/>
                <input class="star" type="radio" name="q4" value="4"/>
                <input class="star" type="radio" name="q4" value="5"/>
            </div>
        </div>     

        <div class="question-wrapper">
            <p>Колко точно стедоволен от продуктаааа?</p>
            <div class="rating_stars_wrapper">
                <input class="star" type="radio" name="q5" value="1"/>
                <input class="star" type="radio" name="q5" value="2"/>
                <input class="star" type="radio" name="q5" value="3"/>
                <input class="star" type="radio" name="q5" value="4"/>
                <input class="star" type="radio" name="q5" value="5"/>
            </div>
        </div>     

    </div>
    
    <hr>

    <input type="submit" class="btn btn-raised" value="Публикувай">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    function fillCategories(selectField, selectToFill, valueName){
        $(selectField).change(function() {
            var value = $(this).val();
            var $subCatWrapp = $(selectToFill).parent('.form-item-select.sub');

            if (value == 0) {
                if (selectField == "#category") {
                    $('.form-item-select.sub').hide();
                }
                $subCatWrapp.hide();
            }else{
                $subCatWrapp.show();
                var obj = jQuery.parseJSON( '{"'+ valueName + '":"' + value + '"}' );

                $.post('functions/category-process.php', obj, function(data) {
                   $(selectToFill).html(data);
                });
            }
        });
    }

    fillCategories("#category", "#subcategory-1", "subCat_1");
    fillCategories("#subcategory-1", "#subcategory-2", "subCat_2");
    fillCategories("#subcategory-2", "#subcategory-3", "subCat_3");

});

</script>