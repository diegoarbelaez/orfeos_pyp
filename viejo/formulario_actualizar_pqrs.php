<!-- MUESTRO EL ESTADO SEGÚN SEA -->
<p></p>
                                    <div class="sbp-preview">
                                        <div class="sbp-preview-content">
                                            <h4>Acciones sobre la PQRS</h4>
                                            <form action="actualizar_estado_pqrs.php" method="POST">
                                                <input type="hidden" name="id_pqrs" value="<?php echo $id_pqrs ?>">
                                                <input type="hidden" name="id_funcionario" value="<?php echo $_SESSION["id_funcionario"] ?>">

                                                <?php
                                                switch ($fila["estado"]) {
                                                    case 1:
                                                ?>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Cambiar estado</label>
                                                            <select class="form-control" id="exampleFormControlSelect1" name="estado">
                                                                <option value="2">En proceso</option>
                                                                <option value="3">Terminada</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Comentarios adicionales</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comentario"></textarea>
                                                        </div>
                                                    <?php
                                                        break;
                                                    case 2:
                                                    ?>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Cambiar estado</label>
                                                            <select class="form-control" id="exampleFormControlSelect1" name="estado">
                                                                <option value="3">Terminada</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Comentarios adicionales</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comentario"></textarea>
                                                        </div>
                                                <?php
                                                        break;
                                                }
                                                ?>
                                                <button type="submit" class="btn btn-success">ACTUALIZAR</button>
                                            </form>
                                        </div>
                                    </div>