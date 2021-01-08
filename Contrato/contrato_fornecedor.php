


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <link rel="stylesheet" href="contrato.css">
</head>
<?php 
// var_dump($_POST);
if (@$_POST['acao'] == 'Salvar') {

    
    if (is_uploaded_file($_FILES['ass_um']['tmp_name'])) {

    
    $img_um="../anexos/contrato/diretora1";
    move_uploaded_file($_FILES['ass_um']['tmp_name'],"$img_um".".jpg"); // line 21
    
    }
    if (is_uploaded_file($_FILES['ass_dois']['tmp_name'])) {

    
        $img_dois="../anexos/contrato/diretora2";
        move_uploaded_file($_FILES['ass_dois']['tmp_name'],"$img_dois".".jpg"); // line 21
        
        }
    

}
?>
<body>
    <page size="A4">
        <form method="POST" enctype="multipart/form-data" action="contrato_fornecedor.php">
           
            <button type="submit" class="float save" name="acao" value="Salvar"> 
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" class="svg-inline--fa fa-save fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z"></path></svg>
                <span>Salvar</span>
            </button>

            <div class="container">
                <h3>CONTRATO DE PRESTAÇÃO DE SERVIÇOS EDUCACIONAIS</h3>
                <div class="paragraph">
                    <b>CONTRATANTE(S): </b><input  type="text" size="50" placeholder="Nome" name="nome_um" id="nome_um">,  portador(a) da Carteira de Identidade n.º	<input  type="text" size="14" placeholder="RG" name="rg_um" id="rg_um">,   e   inscrito   no   CPF/MF sob n.º    <input  type="text" class="cpf" size="14" placeholder="CPF" name="cpf_um" id="cpf_um">

 residente e domiciliado(a) à <input  type="text" size="40" placeholder="Endereço" name="end_um" id="end_um"> e <input  type="text" size="50" placeholder="Nome" name="nome_dois" id="nome_dois">, portador(a) da Carteira de Identidade n.º	<input  type="text" size="14" placeholder="RG" name="rg_dois" id="rg_dois">, inscrita no CPF/MF sob   n.º <input  type="text" size="14" class="cpf" placeholder="CPF" name="cpf_dois" id="cpf_dois">, residente e domiciliado(a) à <input  type="text" size="40" placeholder="Endereço" name="end_dois" id="end_dois">
responsável(eis) pelo(a) aluno(a) <b></b>  <input  type="text" size="55" placeholder="Nome do Aluno" name="nome_aluno" id="nome_aluno" value="<?=$nome?>">
regularmente matriculado(a) no(a)	<input  type="text" size="8" placeholder="Ano/Série" name="ano_serie" id="ano_serie" value="<?=$ano_letivo."/".$serie?>"> ano/série, no turno	<input  type="text" size="10" placeholder="Turno" name="turno" id="turno" value="<?=$turno?>">.
<div class="paragraph">

<b>CONTRATADA:</b> <u><?=@$contratada?>,</u> pessoa jurídica de direito privado, inscrita no CNPJ/MF sob n.º <u><?=@$cnpj?></u>, estabelecida nesta cidade, à <u>Avenida Francisco Araújo de Souza, s/n.
Tucano-BA,</u>  neste ato representada nos termos de seu Contrato  Social.
</div>
<div class="paragraph">
As partes contratantes, acima qualificadas, firmam o presente <b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS EDUCACIONAIS</b>, regido pela legislação brasileira aplicável e pelas cláusulas e condições que seguem, ficando o(s) <b>CONTRATANTE(S)</b> ciente(s), desde logo, da obrigação da <b>CONTRATADA</b> com relação a normas e orientações especiais emanadas dos órgãos responsáveis pela educação brasileira e pela administração dos Sistemas de Ensino, as quais poderão, a qualquer tempo, alterar, suprimir ou acrescentar direitos e deveres às <b>PARTES</b>, mesmo no curso da execução do contrato.
</div>
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA PRIMEIRA:</b> O presente <b>CONTRATO</b> tem como objeto a prestação de serviços educacionais, em favor do(a) aluno(a) indicado(a) no preâmbulo deste <b>CONTRATO</b> e no Requerimento de Matrícula, durante o ano letivo de <u><?=$ano_letivo+1?></u>. Para tanto, a <b>CONTRATADA</b> assegura ao(s) <b>CONTRATANTE(S)</b> uma vaga no seu corpo discente, a ser utilizada pelo(a) aluno(a), beneficiário deste <b>CONTRATO</b>, conforme os dados especificados no <b>Requerimento de Matrícula</b>.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Os efeitos jurídicos do presente <b>CONTRATO</b> estão condicionados ao oportuno deferimento da matrícula do(a) aluno(a), conforme preceituam as normas gerais da Educação Nacional e do Regimento Escolar da <b>CONTRATADA</b>,cujo teor é de conhecimento prévio dos <b>CONTRATANTE(S)</b> e passa a fazer parte do presente <b>CONTRATO</b>.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> Deferida a matrícula, o ensino será ministrado ao(a) aluno(a) por meio de aulas e demais atividades escolares, nos termos da legislação em vigor, em conformidade com o disposto no currículo e no Calendário Escolar para o ano letivo de 2021.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Terceiro:</b> É de inteira responsabilidade da <b>CONTRATADA</b> o planejamento e a execução do ensino, bem como o agendamento das datas de provas e eventos, fixação de carga horária, designação de professores,orientações didático-pedagógica e educacionais,além de outras atividades docentes pertinentes,de acordo com seu exclusivo critério,sem ingerência do(s) <b>CONTRATANTE(S)</b>.
                </div>
                <div class="paragraph">
                    <b>Inciso I:</b> Fica(m) o(s) <b>CONTRATANTE(S)</b> ciente(s) de que o(a) aluno(a) só poderá freqüentar  as dependências da <b>CONTRATADA</b> em turno oposto ao de sua matrícula, mediante autorização prévia desta, não constituindo obrigação da mesma a cessão de espaço físico e/ou material didático-pedagógico para atividades realizadas pelo(a) aluno(a), sem orientação de um(a) funcionário(a) da <b>CONTRATADA</b> professor (a) ou não, fora do horário de prestação de serviços contratados.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quarto:</b> O <b>CONTRATANTE</b> manifesta ciência de que, se o presente instrumento vier a ser celebrado e os serviços nele previstos vierem a ser prestados no curso do estado legal de calamidade pública em decorrência de ato Estadual, Municipal ou Federal, da pandemia do COVID-19, ou seja, no qual as aulas presenciais estarão proibidas de serem realizadas, a <b>CONTRATADA</b> poderá lançar mão das medidas pedagógicas autorizadas por meio da Portaria MEC 544, sobretudo as adaptações necessárias para a prestação dos serviços por meio de aulas não presenciais, conforme expressa determinação e autorização da legislação vigente.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quinto:</b> Reserva-se à <b>CONTRATADA</b>, o direito de cancelar, até 30 (trinta) dias, antes do início de cada período letivo, qualquer turma cujo número de alunos seja inferior a 25 (vinte e cinco) proporcionando ao (a)aluno(a),neste caso,o direito de ocupar uma vaga em outra turma do mesmo ano,no mesmo ou em outro turno,caso ofertado pela <b>CONTRATADA</b>,ou de reclamar a devolução integral dos valores eventualmente pagos, mediante o cancelamento da matrícula e rescisão deste <b>CONTRATO</b>.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA SEGUNDA:</b> Os(as) alunos(as) com deficiências serão aceitos pela escola, fazendo com que as diferenças sejam reconhecidas e valorizadas,reforçando o respeito ao direito de todos, nos termos da Constituição Federal, da Lei n.º 9.394/1996 (Lei de Diretrizes e Bases da Educação Nacional), da Lei n.º 8.068/1990 (Estatuto da Criança e do Adolescente) e da Lei n.º 13.146/20015 (Estatuto da Pessoa com Deficiência).
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Para a efetivação da matrícula, será observada a disponibilidade de vagas, por turma, série/ano,na forma prevista no Regimento Escolar da <b>CONTRATADA</b> e/ou de acordo com a regulamentação emanada pelos Conselhos  Locais (Estadual e/ou Municipal).
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> A deficiência deve ser declarada pelo(s) <b>CONTRATANTE(S)</b>, no ato da matrícula, fazendo-se necessário que apresentem, além do laudo médico, a avaliação psicodiagnóstica e/ou relatório de acompanhamento médico, psicológico ou psicopedagógico, assim como, aqueles de acompanhamento periódico, no tempo hábil solicitado pelo Serviço de Orientação Educacional da <b>CONTRATADA</b>.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Terceiro:</b> Quando a deficiência não for declarada pelo(s) <b>CONTRATANTE(S)</b> e o(a) aluno(a) apresentar alguma dificuldade de aprendizagem em seu processo educativo, cognitivo, físico, motor ou relacional (dentro do espaço da Escola), a família e/ou responsáveis serão comunicados para que procurem profissionais da área de saúde, apresentando os devidos relatórios para acompanhamento específico pela <b>CONTRATADA</b>.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quarto:</b> Ficam o(s) <b>CONTRATANTE(S)</b> responsável(is) por promover o contato do profissional da área de saúde, que esteja acompanhando diretamente o(a) aluno(a) com a escola, de modo que este possa orientar os profissionais da Instituição de Ensino sobre como acompanhar o(a) educando(a), buscando o melhor desenvolvimento social e cognitivo.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quinto:</b> É de responsabilidade do(s) <b>CONTRATANTE(S)</b>, o acompanhamento extra  escolar de todas as necessidades pessoais e individuais do(a) aluno(a), que possam facilitar e colaborar com seu desenvolvimento.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA TERCEIRA:</b> Como contraprestação pelos serviços descritos na Cláusula Primeira, referentes ao período letivo de 2021, o(s) <b>CONTRATANTE(S)</b> e/ou pagará(ão) à <b>CONTRATADA</b> uma anuidade escolar, REAJUSTADA a partir de janeiro próximo,  à vista ou dividida <b>em 12(doze) parcelas</b>, conforme determinado pela <b>CONTRATADA</b> .
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA QUARTA:</b> Em obediência a Lei aprovada pela Assembleia Legislativa do Estado e publicada no Diário Oficial de 13 de agosto do ano em curso, os descontos das mensalidades, <b class="under">enquanto durar a pandemia</b>, são estabelecidos em <b class="under">30, 25 e 22,5%, respectivamente</b>, e por nível de ensino, calculados obedecendo o que trata o parágrafo 5º do Art.1º da referida Lei, em cuja redação, <b>“ é vedada a cumulação de benefícios”</b> (outros descontos concedidos por mera liberalidade da escola).
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Após a extinção do desconto referente à pandemia do COVID-19, a <b>CONTRATADA</b> poderá conceder às famílias com dois ou mais filhos matriculados o percentual de 15%(quinze por cento) e 20% ( vinte por cento), respectivamente, de desconto sobre a mensalidade do filho de menor nível de ensino.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> <b class="under">Durante o período da pandemia</b>, os descontos <b>NÃO  serão cumulados</b>.Vigorará apenas o desconto aprovado pela Assembleia Legislativa na Lei 14279 de 12 de agosto ,publicada no Diário Oficial de 13 /08/2020,conforme descrição abaixo: 
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>MENSALIDADE</th>
                                <th>DESC.PANDEMIA</th>
                                <th>VLR.A PAGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>EDUC.INFANTIL</td>
                                <td>R$ 390,00</td>
                                <td>(30%)</td>
                                <td>R$ 275,00</td>
                            </tr>
                            <tr>
                                <td>ENS.FUND.I</td>
                                <td>R$ 440,00</td>
                                <td>(25%)</td>
                                <td>R$ 330,00</td>
                            </tr>
                            <tr>
                                <td>ENS.FUND. II</td>
                                <td>R$ 540,00</td>
                                <td>(25%)</td>
                                <td>R$ 405,00</td>
                            </tr>
                            <tr>
                                <td>ENSINO MÉDIO (1ª.e2ª.séries)</td>
                                <td>R$ 675,00</td>
                                <td>(22,5%)</td>
                                <td>R$ 505,00</td>
                            </tr>
                            <tr>
                                <td>3ª.série</td>
                                <td>R$ 720,00</td>
                                <td>(22,5%)</td>
                                <td>R$ 558,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="paragraph">
                    <b>Parágrafo Terceiro</b>: O pagamento das parcelas mensais da anuidade escolar deverá ser feita nos Bancos autorizados pela <b>CONTRATADA</b>, até o dia 10 do próprio mês de referência de cada parcela, conforme a <b>EXEMPLIFICAÇÃO</b> abaixo:
                    <table>
                        <thead>
                            <tr>
                                <th>MESES/VENCIMENTOS</th>
                                <th>REFERÊNCIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ATÉ O DIA 10/01/2021</td>
                                <td>MATRÍCULA</td>
                            </tr>
                            <tr>
                                <td>10/02/2021</td>
                                <td>FEVEREIRO</td>
                            </tr>
                            <tr>
                                <td>10/03/2021</td>
                                <td>MARÇO</td>
                            </tr>
                            <tr>
                                <td>e assim por diante</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quarto:</b> Caso o pagamento seja efetuado após a data de vencimento, ajustada acima, o valor da parcela será acrescido de multa contratual de 2% (dois por cento), de juros de mora de 1% (um por cento) ao mês, e da perda de eventual desconto, se houver.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Quinto:</b> É de exclusiva responsabilidade do(s) <b>CONTRATANTE(S)</b> a aquisição de material escolar de uso individual do(a) aluno(a), não configurando esta aquisição, em hipótese nenhuma, como parte integrante da anuidade aqui contratada.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Sexto:</b> O (s) <b>CONTRATANTE(S)</b> fica(m), desde já, ciente(s) de que a <b>CONTRATADA</b> não dispõe ou indica transporte escolar, sendo a utilização deste de sua inteira responsabilidade. 
                </div>
                <div class="paragraph">
                    <b>Parágrafo Sétimo:</b> Eventual abatimento, desconto ou redução no valor da parcela da anuidade, quando ocorrer, constituirá mera liberalidade da <b>CONTRATADA</b>, não implicará novação, e poderá ser suprimido a qualquer tempo, inclusive em caso de inadimplência, sem que haja necessidade de qualquer notificação judicial e extrajudicial.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Oitavo</b>: Tem ciência, neste ato, o(s) <b>CONTRATANTE(S)</b> que, em caso de inadimplência das parcelas ou qualquer obrigação de pagamento decorrente do presente <b>CONTRATO</b> por 90(noventa)dias ou mais,poderá a <b>CONTRATADA</b>,além de não renovar a matrícula do(a) aluno(a) para o período letivo seguinte, conforme estipula o art. 5.º da Lei n.º 9870/99, valer-se dos meios administrativos e judiciais cabíveis para a cobrança de seu crédito, reservando-se o direito de inscrever o(s) nome(s) do(s)
<b>CONTRATANTE(S)</b> em bancos de dados cadastrais (SPC/SERASA) e de valer-se de firma especializada  de cobrança ara reaver os valores em aberto. 
                </div>
                <div class="paragraph">
                    <b>Parágrafo Nono:</b> A <b>CONTRATADA</b> poderá negociar com instituições financeiras e afins, inclusive para que recebam diretamente do(s) <b>CONTRATANTE(S)</b> , o valor total ou parcial do crédito relativo à anuidade escolar ora contratada, respeitados, até a data de seus vencimentos, os valores nominais das parcelas e, após o vencimento, valer-se dos mecanismos próprios de cobrança, inclusive os judiciais,sendo o(s) <b>CONTRATANTE(S)</b> responsáveis  pelas custas e/ou taxas, quando houver.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Décimo:</b> O(s) <b>CONTRATANTE(S)</b> tem ciência das formas de pagamento aceitas pela <b>CONTRATADA</b> e expressam seu aceite para que sejam emitidos boletos bancários para pagamento na rede bancária. Em caso de boletos emitidos mediante registro próprio da instituição financeira, estes poderão ser encaminhados a protesto, ultrapassados 90 (noventa) dias de seu vencimento. A <b>CONTRATADA NÃO</b> receberá pagamento com cheque.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Décimo Primeiro</b>: O não comparecimento do(a) aluno(a) aos atos escolares, ora contratados, não exime o(s) <b>CONTRATANTE(S)</b> do pagamento das parcelas da anuidade, tendo em vista a disponibilidade do serviço colocado pela <b>CONTRATADA</b> ao(s) <b>CONTRATANTE(S)</b>.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Décimo Segundo:</b> O(s) <b>CONTRATANTE(S)</b> possui(em)conhecimento prévio das  condições financeiras deste <b>CONTRATO</b>, de acordo com a Lei n.º 9.870/99 (Lei das Anuidades Escolares) e Decreto n.º 3.274/1999, conhecendo-as e aceitando-as livremente.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Décimo Terceiro:</b> Conforme autorizado pelo disposto no Artigo 5º da Lei 9.870/1999 (Lei das Anuidades Escolares), declaram o(s) <b>CONTRATANTE(S)</b> que possui(em)conhecimento de que a instituição de ensino pode se recusar a deferir a (re)matrícula de alunos que porventura estejam inadimplentes no momento da  (re)matrícula,  inobstante a cobrança de referidos valores.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Décimo Quarto:</b> As partes manifestam expresso conhecimento de que o preço dos serviços que está acordado na cláusula quarta,parágrafo primeiro, considera  o regime tributário vigente no momento da fixação do preço e celebração deste contrato. Assim, em havendo alteração do regime de tributação incidente sobre os serviços contratados, inclusive em decorrência de ato governamental ou parlamentar (reforma tributária em trâmite perante o Congresso Nacional) que vier a ser aprovado na vigência da execução deste contrato, impactando, assim, o seu custo de maneira imediata, haverá a consequente readequação do preço do contrato, como forma de manutenção do equilíbrio econômico-financeiro.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA QUINTA:</b> Os valores da contraprestação acordada na cláusula terceira satisfazem, <b>exclusivamente</b>, à prestação de serviços decorrentes da carga horária constante da proposta curricular (Curso Regular) da <b>CONTRATADA</b> e de seu calendário escolar.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Este <b>CONTRATO</b> não inclui o fornecimento de material didático de uso individual, livros, apostilas, estudos de recuperação, cursos paralelos e outros serviços facultativos. 
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> Os serviços extraordinários efetivamente prestados ao(a) aluno(a),dos quais citamos <b>exemplificativamente</b>, segunda chamada de provas, testes e exames, que requeiram a presença do professor, inclusive atividades de adaptação de estudos, serão cobrados à parte, conforme determinado pela <b>CONTRATADA</b>.
                </div>
                <div class="paragraph">
                    <b>I - SEGUNDA CHAMADA:</b> será cobrada por disciplina o equivalente a 5% (cinco por cento) sobre a parcela da anuidade escolar vigente à época do serviço.
                </div>
                <div class="paragraph">
                    <b>II- RECUPERAÇÃO PARALELA:</b> será cobrada por disciplina o equivalente a 5% (cinco por cento) sobre a parcela da anuidade escolar vigente à época do serviço, e 10% (dez por cento), caso necessitar da presença do professor.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Terceiro:</b> O(s) <b>CONTRATANTE(S)</b> declara(m) que teve(tiveram) conhecimento dos valores cobrados por esses serviços extraordinários e sua consequente cobrança.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA SEXTA:</b> A CONTRATADA, por mera liberalidade, adota o <b>“Sistema Positivo de Ensino”</b>,para as turmas da Educação Infantil até  o 2º ano do Ensino Fundamental e o <b>Sistema COC</b>, do 3º ano do Ensino Fundamental até o 3º ano do Ensino Médio, os quais estão de acordo com a sua Proposta Pedagógica, com a Lei de Diretrizes e Bases da Educação Nacional,  e sua prestação de serviços de ensino ocorrerá mediante a utilização do <b>MATERIAL DIDÁTICO/LIVRO DIDÁTICO INTEGRADO</b>, fornecido nas formas impressa e/ou digital, desenvolvidos especialmente para os alunos  das escolas conveniadas, atualizados periodicamente, constituindo, assim, um elemento essencial ,para o bom andamento do trato pedagógico do(a) aluno(a)beneficiário(a).
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> As obrigações referentes ao <b>MATERIAL DIDÁTICO</b> serão ajustadas em documento próprio.
                </div>
                <div class="paragraph">
                    <b>Inciso I:</b> Tem o(s) <b>CONTRATANTE(S)</b> ciência de que o <b>MATERIAL DIDÁTICO</b> mencionado no caput desta Cláusula é consumível, nos termos do art. 86 do Código Civil, não podendo ser reaproveitados em ano posterior.
                </div>
                <div class="paragraph">
                    <b>Inciso II:</b> Tem o(s) <b>CONTRATANTE(S)</b> ciência de que o <b>MATERIAL DIDÁTICO</b> mencionado no caput desta Cláusula está protegido pela Lei n.º9.610/1998(Lei dos Direitos Autorais) não podendo ser reproduzido, fotografado, digitalizado ou fotocopiado no todo ou em parte.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> Fica(m) o(s) <b>CONTRATANTE(S)</b> ciente(s) da obrigatoriedade de adquirir o material didático-pedagógico, necessário ao aprendizado do(a) aluno(a).
                </div>
                <div class="paragraph">
                    <b>Parágrafo Terceiro:</b> Fica(m) ciente(s) o(s) <b>CONTRATANTE(S)</b> de que é por  mera liberalidade da <b>CONTRATADA</b> fazer adoção do material didático-pedagógico em forma de módulos ou livros didáticos para todos os seus níveis de ensino.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA SÉTIMA:</b> Obriga(m)-se o(s) <b>CONTRATANTE(S)</b>, no ato da matrícula, a indicar e autorizar por escrito o médico, a clínica ou o hospital que preferencialmente deverá ser encaminhado(a) o(a) aluno(a), em caso de emergência.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Caso não ocorra o nexo causal, ou falha no cumprimento legal do dever de vigilância por parte da <b>CONTRATADA</b>, o(s) <b>CONTRATANTE(S)</b> deverá(ão)se responsabilizar pelas despesas havidas no    atendimento.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> Nos casos em que o(a) aluno(a) utilizar medicamento prescrito,a escola não se responsabilizará em administrá-lo.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA OITAVA:</b> O presente <b>CONTRATO</b> poderá ser rescindido, unilateralmente,nos termos do artigo 473, caput e parágrafo único do Código Civil, por iniciativa do(s) <b>CONTRATANTE(S)</b>, mediante requerimento escrito, assinado de forma conjunta pelos responsáveis, independentemente da convivência ou não com os filhos, de regulamentação de guarda ou de status marital, protocolado junto à Secretaria da <b>CONTRATADA</b>, com antecedência mínima de 30(trinta)dias, ou por acordo entre a <b>CONTRATADA</b> e o(s) <b>CONTRATANTE(S)</b>,ajustado por escrito. 
                </div>
                <div class="paragraph">
                    <b>Parágrafo Primeiro:</b> Fica(m) o(s) <b>CONTRATANTE(S)</b> obrigado(s) a quitar o valor integral da parcela do mês em que o requerimento  mencionado no“caput”desta cláusula for protocolado,além de outros débitos eventualmente existentes . 
                </div>
                <div class="paragraph">
                    <b>Parágrafo Segundo:</b> Caso o(s) <b>CONTRATANTE(S)</b> formalizem pedido de desistência até o dia útil anterior ao início das aulas,a <b>CONTRATADA</b> efetuará a devolução de 80%(oitenta por cento)dos valores pagos, ficando o restante destinado a cobrir as despesas administrativas, tributos e contribuições incidentes sobre os pagamentos que tenham sido suportados pela <b>CONTRATADA</b>. Se a desistência ocorrer depois do primeiro dia letivo, não serão devolvidos quaisquer valores.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA NONA:</b> Ao firmar o presente contrato o(s) <b>CONTRATANTE(S)</b> declaram que tem conhecimento prévio do Regimento Escolar e das instruções específicas, submetendo-se as suas disposições, bem como das demais obrigações decorrentes da legislação aplicável à área de ensino. O Regimento Escolar e demais instruções estarão à disposição do(s) <b>CONTRATANTE(S)</b> para consulta, no endereço da <b>CONTRATADA</b>.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA:</b> O(s) <b>CONTRATANTE(S)</b> assume(m) total responsabilidade quanto à veracidade das declarações prestadas, neste <b>CONTRATO</b> e no ato da matrícula,relativas à aptidão legal do(a) aluno(a) para a frequência na série/ano indicados.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA PRIMEIRA:</b> O(s) <b>CONTRATANTE(S)</b> ficam cientes, desde logo, da obrigatoriedade do uso completo do uniforme escolar, assumindo inteiramente a responsabilidade por qualquer prejuízo acadêmico que o aluno venha a enfrentar em decorrência do descumprimento desta obrigação.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA SEGUNDA:</b> O(s) <b>CONTRATANTE(S)</b> compromete(m)-se  comunicar expressamente à <b>CONTRATADA</b> acerca da existência e do teor de decisões judiciais que venham alterar as condições
da prestação de serviços e/ou determinar novas providências necessárias ao atendimento do pronunciamento judicial, não se responsabilizando a <b>CONTRATADA</b> por quaisquer fatos decorrentes da não observância da presente cláusula.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Único:</b> No mesmo sentido, fica claro que, ainda que a guarda da criança não seja compartilhada, o cônjuge que não detém a guarda não está alienado(da)à educação do (a)filho(a),de modo que dela deve participar ativamente, o que autoriza a <b>CONTRATADA</b> a permitir o contato do mesmo com o(a)aluno(a),dentro de suas dependências,seja pessoalmente ou por qualquer outro meio (telefone, e-mail).
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA TERCEIRA:</b> Caso, no curso da vigência do presente <b>CONTRATO</b>, venha  ocorrer a substituição de qualquer(quaisquer) <b>CONTRATANTE(S)</b>,por qualquer motivo,a <b>CONTRATADA</b> deverá ser comunicada de maneira formal e escrita ou por intermédio de notificação extrajudicial, assinada em conjunto pelo(s) <b>CONTRATANTE(S)</b>.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA  DÉCIMA QUARTA:</b> <b>CONTRATADA</b> e <b>CONTRATANTE(S)</b> comprometem-se  comunicar, por    
escrito,  qualquer mudança de endereço, e-mail e telefones de contato,sob pena de serem consideradas 
válidas as correspondências enviadas aos endereços e e-mails constantes do presente contrato, inclusive para efeitos de citação  Judicial, podendo esta  ser  efetivada por edital.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Único:</b> O(s) <b>CONTRATANTE(S)</b> concorda(m), expressamente, que a <b>CONTRATADA</b> envie suas correspondências e comunicações, pelo meio eletrônico, ao endereço de e-mail informado pelo(s) <b>CONTRATANTE(S)</b> e, também, via WhatsApp .
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA QUINTA:</b> A <b>CONTRATADA</b> não se responsabilizará pela perda de material escolar de uso individual ou de pertences pessoais trazidos pelo(a) aluno(a) para o interior da escola, estejam ou não identificados,bem como equipamentos eletrônicos.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Único:</b> Declara(m)-se ciente(s) o(s) <b>CONTRATANTE(S)</b> de que é proibido ao(à) aluno(a)a utilização de telefone celular ou outro aparelho eletrônico durante as aulas,salvo quanto autorizado e supervisionado pelo(a) professor(a), durante a execução de atividades didático- pedagógicas previamente planejadas, ficando a <b>CONTRATADA</b> autorizada a adotar as medidas disciplinares cabíveis, disciplinadas em seu Regimento Interno, nas hipóteses de descumprimento desta proibição.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA SEXTA:</b> O(s) <b>CONTRATANTE(S)</b> declara(m), neste ato e sob as penas da lei:
                </div>
                <div class="paragraph">
                    a) serem verdadeiras todas as informações prestadas no preâmbulo deste instrumento e no processo de matrícula;
                </div>
                <div class="paragraph">
                    b) .estar ciente(s) de que todas as informações coletadas pela <b>CONTRATADA</b> serão por ela utilizadas para as seguintes finalidades: 
                </div>
                <div class="paragraph">
                    I. Criação e atualização do cadastro do(a) aluno(a) perante a <b>CONTRATADA</b>; II.Confirmação da identidade do(a) aluno (a III.Processamento da matrícula do(a)aluno(a); IV. Cadastramento dos dados do(a) aluno(a) e responsáveis em todos os sistemas e plataformas , bem como no banco de dados da referida, para fins de envio de informações relativas a obras didáticas, paradidáticas e literárias, em conformidade à proposta pedagógica adotada pela <b>CONTRATADA</b>; V.Acompanhamento do desenvolvimento pedagógico do(a) aluno(a); VI. Assistência ao(à) aluno(a) e pais/responsáveis legais; VII. Comunicação com pais/responsáveis legais do(a) aluno(a); VIII. Realização de operações internas necessárias para a prestação dos serviços educacionais; IX. Processamento ou cobrança dos pagamentos pelos serviços prestados; X. Melhoria dos serviços da <b>CONTRATADA</b>; XI. Prestação de informações exigidas da <b>CONTRATADA</b> pela lei ou pelas autoridades públicas e órgãos reguladores.XII. estar ciente de que poderá solicitar, a qualquer tempo, o acesso a confirmação ou a correção desses dados por meio de requerimento encaminhado diretamente à Secretaria da <b>CONTRATADA</b>.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA SÉTIMA:</b> Com a finalidade única e exclusiva de prestar os serviços educacionais ora contratados, e nos termos do Artigo 7º, Incisos V e VI da Lei Geral de Proteção de Dados (Lei 13.709/2018) serão coletados os dados pessoais do titular e do beneficiário do presente contrato, sendo tal tratamento realizado com base no exercício regular de direitos dispostos na legislação acima apontada. Os dados serão armazenados durante o período que perdurar o contrato e exclusivamente para sua execução, em respeito a toda a legislação aplicável.
                </div>
                <div class="paragraph">
                    <b>Parágrafo Único:</b> Os contratantes declaram expressa ciência de que o tratamento dos dados pessoais será realizado unicamente para a prática de atos, medidas e demais providências imprescindíveis para a idônea e satisfatória execução do presente contrato, especialmente no que se refere ao seu compartilhamento necessário à gestão dos sistemas da administração escolar, tais como o de segurança, financeiro, educacional (incluindo-se, aqui, portais educacionais de acesso a informações e conhecimentos acadêmicos, bibliotecas, realização de atividades escolares, avaliações acadêmicas, dentre outros) e prestação dos serviços ora contratados.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA OITAVA:</b> A <b>CONTRATADA</b> não estará obrigada a renovar a matrícula do(a) aluno(a) beneficiário(a) deste <b>CONTRATO</b> para o período letivo posterior,caso o(s) <b>CONTRATANTE(S)</b> ou o(a)próprio (a)aluno(a) não tenha(m) cumprido rigorosamente as cláusulas do presente contrato.
                </div>
                <div class="paragraph">
                    <b>CLÁUSULA DÉCIMA NONA:</b> Para dirimir questões oriundas deste contrato, fica eleito o Foro da Comarca de Tucano, objeto deste <b>CONTRATO</b>.
                </div>
                <div class="paragraph">
                    <b>PARÁGRAFO PRIMEIRO:</b> Fica(m) ciente(s) o(s) <b>CONTRATANTE(S)</b> que a matricula do aluno somente
poderá ser efetivada mediante o pagamento da matricula e a assinatura dos pais ou responsáve(is).
                </div>
                <div class="paragraph">
                    E,por estarem <b>CONTRATANTE(S)</b> E <b>CONTRATADA</b> de acordo com todos os termos e condições do presente <b>CONTRATO</b>, assinam este instrumento em duas vias de igual teor e forma, para que se produzam todos os efeitos legais.
                </div>

                <iframe name="I2" width="100%" src="assinatura.php">        
                </div>  
                        
                </iframe>

                <div class="footer">
                    <div class="ass">
                       
                        <div class="line"></div>
                        <span class="label">CONTRATANTE(S)</span>
                    </div>
                    <div class="ass">
                    <div class="assinaturas">
                            <div id="container_ass_um" class="assinatura margin-right">
                                <input required type="file" name="ass_um" id="ass_um" class="ass_file" onchange="readURL(this,'img_um','container_ass_um','preview-um')">
                                <label class="label-file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                    <label for="ass_um">Nova Assinatura</label>
                                </label>
                                <img src="#" alt="Assinatura" class="assinatura" id="img_um">
                            </div>
                            <div class="preview" id="preview-um">
                                <div class="close1" title="Alterar Imagem" onclick="resetImage('img_um','container_ass_um','preview-um')">
                                    <span class="close">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.016 512.016" style="enable-background:new 0 0 512.016 512.016;" xml:space="preserve"> <g> <g> <path d="M510.792,233.896c-1.632-3.904-4.736-7.04-8.672-8.672c-1.952-0.8-4-1.216-6.08-1.216h-48.032 c0-123.52-100.512-224-224-224c-54.208,0-105.472,19.104-146.08,54.112c-6.944,5.984-6.912,16.864-0.48,23.328l45.728,45.76 c5.76,5.76,14.72,5.664,21.088,0.608c22.592-18.016,50.4-27.808,79.744-27.808c70.592,0,128,57.408,128,128H304.04 c-2.112,0-4.16,0.416-6.112,1.216c-3.936,1.632-7.04,4.768-8.672,8.672c-1.632,3.904-1.632,8.32,0,12.224 c0.8,1.984,1.984,3.744,3.488,5.216l95.968,95.968c6.24,6.24,16.384,6.24,22.624,0l95.968-95.968 c1.472-1.472,2.656-3.264,3.488-5.216C512.424,242.216,512.424,237.8,510.792,233.896z"/> </g> </g> <g> <g> <path d="M434.568,434.536l-45.792-45.728c-5.76-5.76-14.72-5.664-21.088-0.576c-22.528,17.984-50.336,27.776-79.68,27.776 c-70.592,0-128-57.408-128-128h47.968c2.08,0,4.16-0.416,6.112-1.216c3.904-1.632,7.04-4.736,8.672-8.672 c1.632-3.904,1.632-8.32,0-12.224c-0.8-1.952-1.984-3.744-3.488-5.216l-95.968-96c-6.24-6.24-16.384-6.24-22.624,0l-95.968,96 c-1.504,1.472-2.688,3.264-3.488,5.216c-1.632,3.904-1.632,8.32,0,12.224s4.736,7.04,8.672,8.672c1.952,0.8,4,1.216,6.08,1.216 h48.032c0,123.488,100.48,224,224,224c54.24,0,105.504-19.136,146.112-54.144C441.032,451.88,441.032,441,434.568,434.536z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                    </span>
                                </div>
                            </div>
                            <div id="container_ass_dois" class="assinatura margin-left">
                                <input required type="file" name="ass_dois" id="ass_dois" class="ass_file" onchange="readURL(this,'img_dois','container_ass_dois','preview-dois')">
                                <label class="label-file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                    <label for="ass_dois">Nova Assinatura</label>
                                </label>
                                <img src="#" alt="Assinatura" class="assinatura" id="img_dois">
                            </div>
                            <div class="preview" id="preview-dois">
                                <div class="close1" title="Alterar Imagem" onclick="resetImage('img_dois','container_ass_dois','preview-dois')">
                                    <span class="close">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.016 512.016" style="enable-background:new 0 0 512.016 512.016;" xml:space="preserve"> <g> <g> <path d="M510.792,233.896c-1.632-3.904-4.736-7.04-8.672-8.672c-1.952-0.8-4-1.216-6.08-1.216h-48.032 c0-123.52-100.512-224-224-224c-54.208,0-105.472,19.104-146.08,54.112c-6.944,5.984-6.912,16.864-0.48,23.328l45.728,45.76 c5.76,5.76,14.72,5.664,21.088,0.608c22.592-18.016,50.4-27.808,79.744-27.808c70.592,0,128,57.408,128,128H304.04 c-2.112,0-4.16,0.416-6.112,1.216c-3.936,1.632-7.04,4.768-8.672,8.672c-1.632,3.904-1.632,8.32,0,12.224 c0.8,1.984,1.984,3.744,3.488,5.216l95.968,95.968c6.24,6.24,16.384,6.24,22.624,0l95.968-95.968 c1.472-1.472,2.656-3.264,3.488-5.216C512.424,242.216,512.424,237.8,510.792,233.896z"/> </g> </g> <g> <g> <path d="M434.568,434.536l-45.792-45.728c-5.76-5.76-14.72-5.664-21.088-0.576c-22.528,17.984-50.336,27.776-79.68,27.776 c-70.592,0-128-57.408-128-128h47.968c2.08,0,4.16-0.416,6.112-1.216c3.904-1.632,7.04-4.736,8.672-8.672 c1.632-3.904,1.632-8.32,0-12.224c-0.8-1.952-1.984-3.744-3.488-5.216l-95.968-96c-6.24-6.24-16.384-6.24-22.624,0l-95.968,96 c-1.504,1.472-2.688,3.264-3.488,5.216c-1.632,3.904-1.632,8.32,0,12.224s4.736,7.04,8.672,8.672c1.952,0.8,4,1.216,6.08,1.216 h48.032c0,123.488,100.48,224,224,224c54.24,0,105.504-19.136,146.112-54.144C441.032,451.88,441.032,441,434.568,434.536z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <span class="label">CONTRATADA</span>
                    </div>
                    
                </div>
            </div>
        </form>
    </page>
</body>
<script src="js/mascaras/mascaras.js"></script>
<script src="js/mascaras/strings.js"></script>
<script src="js/mascaras/datas.js"></script>
<script defer>
function readURL(input,id,container,preview) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      let container_ass = document.getElementById(container);
      let preview_ass = document.getElementById(preview);
    //   preview_ass.style.display = 'block';
      let img = document.getElementById(id);
      img.setAttribute('src',e.target.result);
      img.style.display='block';
    //   container_ass.style.display = 'none';
    // container_ass.style.backgroundImage=e.target.result;
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function resetImage(id, container, preview) {
    let container_ass = document.getElementById(container);
    let preview_ass = document.getElementById(preview);
    container_ass.style.display = 'flex';
    preview_ass.style.display = 'none';
    let img = document.getElementById(id);
    img.parentNode.replaceChild(img.cloneNode(true),img);
}

const mascaras = new Mascaras();
const stringsFunctions = new StringsFunctions();
let cpfs = document.querySelectorAll('.cpf');
let cpfData = '###.###.###-##';
for (let index = 0; index < cpfs.length; index++) {
    const element = cpfs[index];
    // element.setAttribute('size','14');
    mascaras.setItemMascara(element,cpfData,null,true,false);
  }
</script>
</html>
<?
?>