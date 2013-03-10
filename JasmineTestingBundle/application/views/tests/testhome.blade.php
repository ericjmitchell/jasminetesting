@layout('tests.testhometemplate')

@section('runners')
<?php
    foreach ($runners as $value)
    {
        echo '<a href="'.URL::to_route('testRoute').'/'.$value.'">';
        echo $value;
        echo '</a>
    ';
    }
?>
@endsection
