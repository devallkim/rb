<ol class="breadcrumb">
    <li class="active"><i class="fa fa-search fa-fw"></i> '<?php echo $keyword?>' 에 대한 검색결과 입니다.</li>
</ol>
<div class="page-header">
    <form action="<?php echo $g['s']?>/" method="get">
        <input type="hidden" name="r" value="<?php echo $r?>">
        <input type="hidden" name="m" value="<?php echo $m?>">
        <input type="hidden" name="blog" value="<?php echo $B['id']?>">
        <input type="hidden" name="front" value="list" />
        <input type="hidden" name="where" value="subject|tag">
        <div class="input-group input-group-lg">
            <input type="text" name="keyword" class="form-control" value="<?php echo $keyword?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
                </button>
                <button class="btn btn-default" type="button" onclick="this.form.keyword.value='';this.form.submit();">리셋</button>
            </span>
        </div>
    </form>
    <p class="form-control-static text-muted"><?php echo $NUM?>건 검색이 되었습니다.</p>
</div>
