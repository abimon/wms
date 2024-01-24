<style>
    table,
    td,
    th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
<div style="min-height: 60px;">
    <!-- <img src="https://ausaakenya.com/storage/images/logo.png" style="width:60px; float:right"> -->
    <p style="float: left;">{{$serial}}</p>
</div>
<p style="text-align:right;">{{date('d/m/Y')}}</p>
<table class="table table-primary table-striped">
    <thead>
        <tr>
            <th>Account</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$account}}</td>
            <td style="text-align:righ;">{{$sum}}</td>
        </tr>
        <tr >
            <td>Total</td>
            <td style="text-align:right;"><b>{{$sum}}</b></td>
        </tr>
    </tbody>
</table>
<p>Thank you for your contribution.</p>
<p><i>Regards, <br> &copy; {{date('Y')}}WMS</i></p>