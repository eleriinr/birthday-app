<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<style>
table{
  width:100% !important;
}
table,tr,th,td{
  border:none !important;
}
.meil{
width:30% !important;
}
.lisa{
background-color: #088A68;
border: none;
}
td,th{
padding: 5px;
text-align:center;
}
tr:nth-child(even){
background-color: #e6e6e6
}
button {
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.delete{
  background-color: #BC2424;
  border: none;

}
.edit{
  border: none;
  background-color: #3D75AC;

}
.edit:hover{
  background-color: #699CD0;
}
.delete:hover{
  background-color: #D46565;
}
.lisa:hover{
  background-color: #77B179;
}
tr:hover{
  background-color:#C0C6D8;
}
#head:hover{
  background-color: white;
}
.entry-content table {
  border: 0px;
}
.entry-content table tr{
  border: 0px;
}
.cover {
  width:500px;/*just for preview*/
  height:10000px;/*just for preview*/
  background:blue;/*just for preview*/
}
</style>
</head>
<a  href="http://localhost/test/lisa-inimene/"><button class="btn btn-primary lisa">+ Lisa inimene</button></a><br><br>
<table>
  <tr id="head">
    <th>Eesnimi</th>
    <th>Perenimi</th>
    <th>Kuupäev</th>
    <th>Email</th>
    <th>Emaili saaja</th>
  </tr>
  <tr>
    <td>Eleriin</td>
    <td>Rein</td>
    <td>13.08.1998</td>
    <td><nobr>eleriin.r@gmail.com<nobr></td>
    <td></td>
    <td>
      <button type="button" class="btn btn-primary edit">Muuda</button>
    </td>
  </tr>
  <tr>
    <td>Toomas</td>
    <td>Petersell</td>
    <td>31.10.1963</td>
    <td><nobr>toomas.petersell@ut.ee</nobr></td>
    <td></td>
    <td>
      <button type="button" class="btn btn-primary edit">Muuda</button>
    </td>
  </tr>
</table>