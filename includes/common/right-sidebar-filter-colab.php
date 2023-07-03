<div class="sidebar-right no-print" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <a class="sidebar-right-trigger" href="javascript:void(0)">
                <span><i class="mdi mdi-tune"></i></span>
            </a>
            <div class="sidebar-right-inner">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home8"><span><i class="mdi mdi-tune" aria-hidden="true"></i>
                    </span>Configurações de Filtro</a>
                    </li>
                   <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile8"><span><i class="mdi mdi-reload" aria-hidden="true"></i>
                    </span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8"><span><i class="mdi mdi-message-reply-text" aria-hidden="true"></i>
                    </span></a>
                     </li><li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages9"><span><i class="fa fa-cog"></i></span></a>
                    </li> -->
                </ul>

                <div class="tab-content tab-content-default tabcontent-border">
                    <div class="tab-pane fade active show" id="home8" role="tabpanel">
                            <div class="admin-settings" style="display:none">
                            
                            <h4>Colaboradores</h4>
                                <select style="" id="lista_colaborador" name="lista_colaborador[]" value="" multiple="multiple"></select>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <label class="text-label">Exibir Atividades</label>
                                <div class="input-group">
                                    <input class="form-check-input styled-checkbox show_atividades" id="show_atividades" type="checkbox" name="show_atividades" value="0" >
                                    <label for="show_atividades" class="form-check-label check-green ">Sim</label>
                                </div>
                            </div>
                            <div id="box_other" style="display:none;">
                                <p>Data Inicial</p>
                                <span>
                                    <input type="text" name="data_inicial" value="" class="datetimepicker_inicio  data form-control" id="data_inicial">
                                </span>
                                <p>Data Final</p>
                                <span>
                                    <input type="text" name="data_final" value="" class="datetimepicker_inicio data form-control" id="data_final">
                                </span>
                            </div>
                            <p></p>
                            
                            <div>
                                <div style="display: grid;margin-bottom: 20px;">
                                    <button class="btn btn-primary btn-xs" onclick="apply_filter()" type="button"><span>Aplicar Filtro</span></button>
                                </div>
                                <div style="display: grid;margin-bottom: 20px;">
                                    <button id="getPDF" class="btn btn-xs" style="background: #e53935;border-color: #e53935;color:#fff;" onclick="generatePDF()" type="button"><span>Exportar PDF</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>