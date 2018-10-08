<div class="container">
  <h6 class="text-center"><b>DEPARTMENT OF COMPUTER SCIENCE</b><br>
  <b>FACULTY OF PHYSICAL SCIENCES</b><br>
  <b>UNIVERSITY OF BENIN, BENIN CITY.</b>
  </h6>
  <p>
    <b class="text-info">Name:</b> ISUJEH Oladele<br>
    <b class="text-info">Degree:</b> B.sc(Department of Computer Science)<br>
    <b class="text-info">Mat No:</b> PSC0808904<br>
    <b class="text-info">Level GPA:</b> 3.5
  </p>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $this->db->get_where('tbllevel', array('id' =>$get_transtd->leve ))->row()->title  ?>		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Session: <?php echo $this->db->get_where('tblsession', array('id' =>$get_transtd->session ))->row()->session  ?></th>
      </tr>
    </thead>
  </table>
  <table class="table table-bordered table-sm">
  	<thead>
      <tr>
        <th>SN</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Units</th>
        <th>Score</th>
        <th>Total Grade Points</th>
       </tr>
     </thead>
 
  	<tbody>
      <tr>
        <td>1</td>
        <td>CSC110</td>
        <td>Introduction to Computing</td>
        <td>3</td>
        <td>70A</td>
        <td>15</td>
       </tr>
     </tbody>
  </table>
  </div>
</div>