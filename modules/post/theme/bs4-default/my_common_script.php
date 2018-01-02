

<script type="text/javascript">
//<![CDATA[

// 툴팁
 $('[data-toggle="tooltip"]').tooltip()


// 리스트 액션
function actCheck(act)
{
    var f = document.listForm;
    var l = document.getElementsByName('post_members[]');
    var n = l.length;
    var j = 0;
    var i;
    for (i = 0; i < n; i++)
    {
        if(l[i].checked == true)
        {
            j++;
        }
    }
    if (!j)
    {
        alert('선택된 포스트가 없습니다.     ');
        return false;
    }
    if (act == 'multi_delete')
    {
        if (confirm('정말로 삭제하시겠습니까?'))
        {
            getIframeForAction(f);
            f.a.value ='user_multi_post_delete';
            f.submit();
        }
    }else{
        if (confirm('정말로 실행하시겠습니까?       '))
        {
            getIframeForAction(f);
            f.act.value =act;
            f.submit();
        }
    }
    return false;
}
</script>
