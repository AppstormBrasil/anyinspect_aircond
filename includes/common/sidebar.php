<div class="nk-sidebar no-print">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <?php 
                        $user_level = get_user_level();
					 ?>
					<li>
						<a class="has-arrows" href="home" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Painel de Controle</span>
                        </a>
                    </li>
                    
                     <li>
						<a class="has-arrow"href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-account-search"></i><span class="nav-text">Clientes</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="lista-clientes" ><i class="mdi mdi-view-list"></i><span>Lista de Clientes</span></a></li>
							<li><a href="cadastro-cliente"><i class="mdi mdi-account-multiple-plus"></i><span>Cadastro de Clientes</span></a></li>
						</ul>
                    </li>
					<li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-account"></i><span class="nav-text">Colaboradores</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="lista-funcionarios" ><i class="mdi mdi-view-list"></i><span> Lista de Colaboradores</span></a></li>
							<li><a href="cadastro-funcionario"><i class="mdi mdi-account-multiple-plus"></i><span> Cadastro Colaborador</span></a></li>
						</ul>
                     </li>
                   
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Ativos</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-ativos" ><i class="mdi mdi-view-list"></i><span>Lista de Ativos</span></a></li>
						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Ferramentas</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-ferramentas" ><i class="mdi mdi-view-list"></i><span>Lista de Ferramentas</span></a></li>
							<li><a href="cadastro-ferramenta" ><i class="mdi mdi-view-list"></i><span>Cadastro Ferramenta</span></a></li>
                            <li><a href="controle-ferramentas" ><i class="mdi mdi-view-list"></i><span>Controle-Ferramentas</span></a></li>
						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Treinamentos</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-treinamentos" ><i class="mdi mdi-view-list"></i><span>Lista de Treinamentos</span></a></li>
							<!--<li><a href="cadastro-treinamento" ><i class="mdi mdi-view-list"></i><span>Cadastro Treinamento</span></a></li>-->
						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Manuais</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-manuais" ><i class="mdi mdi-view-list"></i><span>Lista de Manuais</span></a></li>
							<li><a href="cadastro-manual" ><i class="mdi mdi-view-list"></i><span>Cadastro Manual</span></a></li>
						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Certificados</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                        <li><a href="lista-certificados-team" ><i class="mdi mdi-view-list"></i><span>Lista de Certificados Funcionários</span></a></li>
							<li><a href="lista-certificados" ><i class="mdi mdi-view-list"></i><span>Modelos de Certificados</span></a></li>
							<li><a href="cadastro-certificado" ><i class="mdi mdi-view-list"></i><span>Cadastro Certificados</span></a></li>
						</ul>
                    </li>
                    <!--<li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i><span class="nav-text">Certificado</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-certificados" ><i class="mdi mdi-view-list"></i><span>Lista de Certificados</span></a></li>
							<li><a href="cadastro-certificado" ><i class="mdi mdi-view-list"></i><span>Cadastro Certificado</span></a></li>
						</ul>
                    </li>-->

                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-content-paste"></i><span class="nav-text">Formulários</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="lista-servicos" ><i class="mdi mdi-view-list"></i><span>Lista de Formulários</span></a></li>
							<li><a href="cadastro-servico"><i class="mdi mdi-library-plus"></i><span>Cadastro Formulário</span></a></li>
							<li><a href="historico-servicos" ><i class="mdi mdi-view-list"></i><span>Histórico de Atividades</span></a></li>

                            <!--<li>
                                <a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                                    <i class="mdi mdi mdi-shopping"></i><span class="nav-text">Produtos</span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="cadastro-produto"><i class="mdi mdi-library-plus"></i><span>Cadastro de Produtos</span></a></li>
                                    <li><a href="lista-produtos" ><i class="mdi mdi-view-list"></i><span>Lista de Produtos</span></a></li>
                                </ul>
                            </li> -->
						</ul>
                    </li>
                    
                    <li>
                        <a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-shopping"></i><span class="nav-text">Estoque</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="lista-produtos" ><i class="mdi mdi-view-list"></i><span>Lista de Produtos</span></a></li>
                            <li><a href="cadastro-prod-venda"><i class="mdi mdi-library-plus"></i><span>Cadastro de Produto</span></a></li>
                            
                            <!--<li><a href="shopping" ><i class="mdi mdi-view-list"></i><span>Grid de Produtos</span></a></li>-->
                        </ul>
                    </li>
                    <!--<li>
                        <a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-content-paste"></i><span class="nav-text">Pacotes</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="cadastro-pacote"><i class="mdi mdi-library-plus"></i><span>Cadastro de Pacotes</span></a></li>
                            <li><a href="lista-pacotes" ><i class="mdi mdi-view-list"></i><span>Lista de Pacotes</span></a></li>
                        </ul>
                    </li> -->
                    <!--<li>
						<a class="has-arrows" href="relatorioempresa" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i><span class="nav-text">Relatórios</span>
                        </a>
                        
                    </li>-->
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i><span class="nav-text">Atividades</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="lista-atividades"><i class="mdi mdi mdi-view-list"></i><span>Atividades</span></a></li>
							<li><a href="lista-atividades-all"><i class="mdi mdi mdi-view-list"></i><span>Todas</span></a></li>
						</ul>
                    </li>
                   
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-account-search"></i><span class="nav-text">SubContratados</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="lista-subcontrato" ><i class="mdi mdi-view-list"></i><span>Lista de SubContrato</span></a></li>
							<li><a href="cadastro-subcontrato"><i class="mdi mdi-account-multiple-plus"></i><span>Cadastro de SubContrato</span></a></li>

						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-cash-multiple"></i><span class="nav-text">Financeiro</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="status-pagamentos"><i class="mdi mdi-account-multiple-plus"></i><span>Pagamentos Abertos</span></a></li>
							<li><a href="historico-servicos-pagamentos-todos" ><i class="mdi mdi-view-list"></i><span>Todos Pagamentos</span></a></li>
						</ul>
                    </li>

                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi mdi-chart-line"></i><span class="nav-text">Indicadores</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="indicadores"><i class="mdi mdi-chart-line"></i><span>Indicador Comparação</span></a></li>
							<li><a href="indicador-mensal"><i class="mdi mdi-chart-line"></i><span>Indicadores Dinâmico</span></a></li>
						</ul>
                    </li>
                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi mdi-map-marker-radius"></i><span class="nav-text">Localização</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
							<li><a href="#lista-localizacao"><i class="mdi mdi-map-marker-radius"></i><span>Lista localizações</span></a></li>
							<li><a href="#cadastro-local"><i class="mdi mdi-map-marker-radius"></i><span>Cadastro localização</span></a></li>
						</ul>
                    </li>

                    <li>
						<a class="has-arrow" href="javascript: void(0);" aria-expanded="false">
                            <i class="mdi mdi-settings"></i><span class="nav-text">Configurações</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="perfil-empresa"><i class="mdi mdi-library-plus"></i><span> Perfil Empresa</span></a></li>
                            <li><a href="gerar-tag"><i class="mdi mdi-qrcode"></i><span>QRCode Generator</span></a></li>
                            <li><a href="cadastro-categoria"><i class="mdi mdi-library-plus"></i><span> Cadastro de Categoria</span></a></li>
						</ul>
                    </li>
                    <li><a style="cursor: pointer;" class="logout_global" aria-expanded="false"><i class="mdi mdi-logout logout_global"></i><span class="nav-text">Sair</span> </a>
                        
                    </li>

                </ul>
            </div>
        </div>