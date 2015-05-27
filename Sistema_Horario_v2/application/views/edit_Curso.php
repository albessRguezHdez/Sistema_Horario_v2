<?php
/*
 * edit_Curso: Editar curso
 * @Sirio
 * @Jesús
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $this->load->view('head/head_vista');
    $this->load->view('header/header_vista');
?>
<div id="body">
    <div class="container">
        <h1 style="background-color: #dddddd"> Editar Curso</h1>
            <div class="row">
		<div class="col-md-6">		
                    <form method="POST">
                        <table class="table table-hover" >
                                <tr>
					<td><label for="NRC">NRC:</label></td>
					<td><input type="text"  name="NRC" id="NRC"/></td>
				</tr>
				<tr>
					<td><label for="IDA">ID Experiencia Educativa:</label></td>
					<td><input type="text"  name="IDA" id="IDA"/></td>
				</tr>
				<tr>
					<td><label for="IDM">ID Maestro: </label></td>
					<td><input type="text"  name="IDM" id="IDM" /></td>
				</tr>
				<tr>
					<td>
						<input class="btn btn-warning btn-lg" type="submit" name="Editar" id="Editar" value="Editar"/></td>
				</tr>
                        </table>
                    </form>	
		</div>
		<div class="col-md-6">
				<div id="iframe">
					<table class="table table-hover">
						<thead>
				            <tr>
				                <th style="text-align:center" >NRC:</th>
				                <th style="text-align:center" >ID Experiencia Educativa:</th>
				                <th style="text-align:center" >ID Maestro:</th>
				           </tr>
        				</thead>
        				<tbody>
							<?php
							$query= $this->db->get('curso');
							if($query->num_rows() > 0){
								if($query != FALSE){
									foreach ($query ->result() as $row){
										echo "<tr>";
										echo "<td style='text-align: center'>".$row->NRC."</td>";
										echo "<td style='text-align: center'>".$row->IDA." "."</td>";
                                        echo "<td style='text-align: center'>".$row->IDM."</td>";
										echo "</tr>";
									}
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>

	<?php 
		if (isset($_POST['Editar'])){		
			$NRC=$_POST['NRC'];
                        $IDA=$_POST['IDA'];
                        $IDM=$_POST['IDM'];
			$data=array(
                                'IDA'=>$IDA,
				'IDM'=>$IDM
				);
                        $this->db->where('NRC',$NRC);
                        $this->db->update('curso', $data);
			redirect('welcome/vista_curso');
		}
	?>	
<?php $this->load->view('footer/footer_vista');?>