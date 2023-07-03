<div class="sidebar-right no-print" >
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
                        <div class="admin-settings">
                            <h4>Escolha a Base</h4>
                            <div>
                            <select style="" id="lista_base" name="lista_base[]" value="REC,GRU,CUR" multiple="multiple">
                                <option selected="selected" value="CUR">CUR</option>
                                <option selected="selected" value="GRU">GRU</option>
                                <option selected="selected" value="REC">REC</option>
                            </select>
                            <h4>Escolha o Tipo</h4>
                            <div>
                            <select style="" id="lista_tipo" name="lista_tipo[]" value="" multiple="multiple">
                            <option value="Administrativo">Administrativo</option>
                            <option selected="selected" value="Calibrável">Calibrável</option>    
                            <option selected="selected" value="GSE">GSE</option>    
                            <option selected="selected" value="Ferramenta">Ferramenta</option>
                            <option value="Ferramental">Ferramental</option>
                               
                            </select>
                            <p>Dias á Vencer</p>
                                <select class="form-control" name="dias_vencer" id="dias_vencer">
                                    <option value="30">30</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="60">60</option>
                                    <option value="90">90</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <p></p>
                            <div id="box_other" style="display:none;">
                                <p>Digite a quantidade de Dias</p>
                                <span>
                                    <input type="text" name="dias_vencer_custom" value="" class="form-control" id="dias_vencer_custom">
                                    <label for="nav_header_bg_1"></label>
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