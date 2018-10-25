<?php
  // header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  // header("Content-Disposition: attachment; filename=ReporteVentas.xls");
  // echo "<pre>".json_encode($businesses, JSON_PRETTY_PRINT)."</pre>";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <thead>
        <tr align='center'>
          <th colspan='3'>Reportes de ventas desde {{ $startDate }} hasta {{ $endDate }}</th>
        </tr>
        <tr>
          <th>Areas</th>
          <th>DNI</th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Nombre</th>
          <th>Desayunos</th>
          <th>Almuerzos</th>
          <th>Cenas</th>
          <th>Total de Productos</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($businesses as $keyBusiness => $business)

          @foreach ($business->offices as $keyOffice => $office)
            @foreach ($business->jobs as $keyJob => $job)
              <tr>
                <td>{{ $business->name }} - {{ $office->name }} - {{ $job->name }}</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
                <td>Texto</td>
              </tr>
            @endforeach
          @endforeach
        @endforeach
      </tbody>
    </table>
  </body>
</html>
