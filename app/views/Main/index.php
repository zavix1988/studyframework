<div class="container">
    <div id="answer"></div>
    <button class="btn btn-default" id="send">Кнопка</button>
    <br />
    <?php new \fw\widgets\menu\Menu([
        'tpl' => WWW . '/menu/select.php',
        'container' => 'select',
        'class' => 'my-menu',
        'table' => 'categories',
        'cache' => 3600,
        'cacheKey' => 'menu_select',
    ]);?>
    <?php if (!empty($books)):?>
    <?php foreach($books as $book):?>
    <div class="panel panel-default">
        <div class="panel-heading"><?=$book['name']?></div>
        <div class="panel-body">
            <?=$book['slug'];?>
        </div>
    </div>
    <?php endforeach?>
    <?php endif;?>
</div>
<script src="/js/test.js"></script>
<script>
    $('#send').click(function(){
        $.ajax({
            type: "POST",
            url: "main/test",
            data: {'id': 2},
            success: function(res){
/*                var data = JSON.parse(res);
                $('#answer').html('<p>Ответ ' + data.answer + ' Код ' + data.code + '</p>');*/
                $('#answer').html(res);
                console.log(res);
            },
            error: function(){
                alert('Error');
            }
        });
    });
</script>