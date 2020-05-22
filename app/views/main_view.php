<?
session_start(); 
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] == 1){?>
    <br/>admin 
<?}?>
<div class="table-header">
    <h1>Tasks</h1>
</div>


<div class="table">
    <div class="row">
        <div class="col-xl-2">
            <a href="/" id="user_name">Name</a>
        </div>
        <div class="col-xl-3">
            <a href="/" id="user_email">Email</a>
        </div>
        <div class="col-xl-6">
            Text
        </div>
        <div class="col-xl-1">
            <a href="/" id="task_status" >Status</a>
        </div>
    </div>

    <?php foreach($data["CONTENT"] as $row){ ?>
        <div class="row task">
            <div class="col-xl-2">
                <?=$row['user_name'];?>
            </div>
            <div class="col-xl-2">
                <?=$row['user_email'];?>
            </div>
            <div class="col-xl-7">
            <div id=<?=$row['task_id']?>
                <?if(isset($_SESSION['authorized']) && $_SESSION['authorized'] == 1){ ?> 
                    class = admin_text><?}else{?>class = user_text><?}?>
                <?=$row['text']?></div>
            </div>
            <div class="col-xl-1">
                <?if(isset($_SESSION['authorized']) && $_SESSION['authorized'] == 1){ ?>
                <input class="stat_check" type="checkbox" id="<?=$row['task_id'];?>"name="status" <?if($row['task_status']){?>checked<?}?>> 
                <?php }else{?>
                    <input class="stat_check" type="checkbox" id="<?=$row['task_id'];?>"name="status" disabled <?if($row['task_status']){?>checked<?}?>> <?php
                }?>
            </div>
        </div>
    <?}?>
</div>
<?if(!empty($data["SUCCESS"])){?><div class="success"><span><?=$data["SUCCESS"]?></span></div><?}?>
<?if(!empty($data["error_email"])){?><div class="error"><span><?=$data["error_email"]?></span></div><?}?>
<div class="row">
    <div class="col-xl-6">
        <form id="add-form" action="/main/add/" method="POST">
            <div class="row justify-content-center form-header">
                Add task
            </div>
            <div class="row justify-content-between form-row" form-header">
                <div class="col-xl-3 ">
                    <label for="name" >Username</label>
                </div>
                <div class="col-xl-9">
                    <input type="text" id="name" name="name" value="" required>
                </div>
            </div>
            <div class="row justify-content-between form-row" form-header">
                <div class="col-xl-3">
                    <label for="email">Email</label>
                </div>
                <div class="col-xl-9">
                    <input type="text" id="email" name="email" value="" required>
                </div>
            </div>
            <div class="row justify-content-between form-row" form-header">
                <div class="col-xl-3"> 
                    <label for="text">Text</label>
                </div>
                <div class="col-xl-9">
                    <textarea id="text" name="text" value="" required></textarea>
                </div>
            </div>
            <input type="submit" id="form-submit-btn" value="add">
        </form>
    </div>
</div>
<div class="row justify-content-center" id="pagination">
    <div class="col-xl-9">
        <div class="row">
            <? for ($i = 0; $i < $data["LUST_PAGE"]; $i++): ?>
                <div class="col-xl">
                    <span class="page_number"><?if($i + 1 == $data["PAGE"]){?><u><?=$i + 1;?></u><?} else{?><?=$i + 1;?><?}?></span>
                </div>
            <? endfor; ?>
        </div>
    </div>
</div>
