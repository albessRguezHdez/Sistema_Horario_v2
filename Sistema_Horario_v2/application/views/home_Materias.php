<?php
/*
 * home_Materias: vista principal de experiencias educativas
 * @Sirio
 * @Jesús
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $this->load->view('head/head_vista');
    $this->load->view('header/header_vista');
?>
<!--
Vista Maestros:
@Sirio
@Jesús
-->
<div id="body">
<div class="container">
  <h1  style="background-color: #dddddd">Experiencias Educativas</h1>
  <table class="table table-striped" style="text-align:center" >
           <thead>
              <tr>
                  <th style="text-align:center" >NRC:</th>
                  <th style="text-align:center" >Experiencia Educativa:</th>
                  <th style="text-align:center" >Carrera:</th>
                  <th style="text-align:center" >Horas</th>
                  <th style="text-align:center" >Requisitos Previos</th>
                  <th style="text-align:center" >Creditos</th>
                  <th style="text-align:center" >Editar</th>
                  <th style="text-align:center" >Eliminar</th>
             </tr>
           </thead>
           <tbody>
          <tr>
           <?php 
                $query = $this->db->get('Asignatura');
                 if ($query->num_rows() > 0){
                    if( $query != FALSE ){
                        foreach ($query ->result() as $row) {
                             
                                echo "<tr>";
                                echo "<td>".$row->IDA."</td>"; 
                                echo "<td>".$row->Asignatura."</td>"; 
                                echo "<td>".$row->Carrera."</td>";
                                 echo "<td>".$row->Horas."</td>";
                                 echo "<td>".$row->Requerimiento."</td>";
                                 echo "<td>".$row->Creditos."</td>";
                                 echo "<td>";
                                    echo "<a href='agregar_materias' class='label label-info'>";
                                    echo "<span class='glyphicon glyphicon-pencil'></a></span>";  
                                echo "</td>";
                                echo "<td>";
                                    echo "<a href='editar_Materias' class='label label-info'>";
                                    echo "<span class='glyphicon glyphicon-pencil'></a></span>";  
                                echo "</td>";
                                echo "<td>";
                                    echo "<a href='eliminar_Materias' class='label label-danger'>";
                                    echo "<span class='glyphicon glyphicon-remove'></a></span>";  
                                echo "</td>";
                                echo "</tr>"; ?>    
                       <?php } 
                    }else{
                        echo "no hay enlaces";
                    }
                }else{
                    return FALSE;
                }
            ?>
       </tbody>
     
    
  </table>
</div>
<?php $this->load->view('footer/footer_vista');?>
