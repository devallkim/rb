<?php
$year_arr=array();
$years=db_query("select * from ".$table[$m.'month']." where blog=".$B['uid']." group by year desc",$DB_CONNECT);
while($Y=db_fetch_array($years)) $year_arr[]=$Y;

?>
<section class="rb-blog rb-blog-list">
    <div class="rb-blog-heading">
        <div class="page-header">
            <h2><i class="fa fa-archive"></i> 아카이브</h2>
        </div>
    </div>
    <div class="rb-blog-body">
        <div class="row">
          <?php for($i=0;$i<count($year_arr);$i++):?>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $year_arr[$i]['year']?>년</h3>
                    </div>
                    <div class="list-group">
                        <?php $MP=getDbArray($table[$m.'month'],"blog=".$B['uid']." and  date like '".$year_arr[$i]['year']."%'",'*','date','desc',12,1);?>
                        <?php while($_MP=db_fetch_array($MP)):?>
                         <a href="<?php echo $g['blog_front']?>list&amp;where=term&amp;_date=<?php echo $_MP['date']?>" class="list-group-item">
                            <?php echo substr($_MP['date'],0,4 )?>년 <?php echo substr($_MP['date'],4,2)?>월 
                            <?php if($_MP['num']):?> <span class="badge"><?php echo $_MP['num']?></span><?php endif?>
                        </a>
                        <?php endwhile?>
                    </div>
                 </div>
            </div>
          <?php endfor?>
        </div>
    </div>
    <div class="rb-blog-footer">
    </div>
</section>
