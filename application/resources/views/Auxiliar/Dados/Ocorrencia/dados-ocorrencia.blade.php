<ul class="collapsible" data-collapsible="expandable">
  <li>
    <div class="collapsible-header"><i class="material-icons">face</i>Registrante {{ $ocorrencia['responsavel']['nome'] }}</div>
    <div class="collapsible-body">
        <p>Identidade: {{ $ocorrencia['responsavel']['identidade'] }}</p>
        <p>Data de Nascimento: {{ $ocorrencia['responsavel']['dt_nascimento'] }}</p>
        <p>Endereço: {{ $ocorrencia['responsavel']['endereco'] }}</p>
    </div>
  </li>
  <li>
    <div class="collapsible-header"><i class="material-icons">assignment</i>Dados da ocorrência {{ $ocorrencia['protocolo'] }}</div>
    <div class="collapsible-body">
      <p>Tipo: {{ $ocorrencia['tipo'] }}</p>
      <p>Protocolo: {{ $ocorrencia['protocolo'] }}</p>
      <p>Data: {{ $ocorrencia['data'] }}</p>
      <p>Descrição: {{ $ocorrencia['descricao'] }}</p>
      <p>Endereço: {{ $ocorrencia['endereco'] }}</p>
    </div>
  </li>

  @if($ocorrencia['objetos'] != null)
  <li>
    <div class="collapsible-header"><i class="material-icons">business_center</i>Objetos envolvidos</div>
    <div class="collapsible-body">
      @foreach($ocorrencia['objetos'] as $objeto)
      <p>Tipo: {{ $objeto['tipo_objeto'] }}</p>
      <p>Unidade de Medida: {{ $objeto['un_medida'] }}</p>
      <p>Quantidade: {{ $objeto['quantidade'] }}</p>
      <p>Descrição: {{ $objeto['descricao'] }}</p>
      <div class="divider"></div>
      @endforeach
    </div>
  </li>
  @endif

  @if($ocorrencia['envolvidos'] != null)
  <li>
    <div class="collapsible-header"><i class="material-icons">wc</i>Pessoas envolvidas</div>
    <div class="collapsible-body">
      @foreach($ocorrencia['envolvidos'] as $envolvido)
        <p>Nome: {{ $envolvido['nome'] }}</p>
        <p>Identidade: {{ $envolvido['identidade'] }} - CPF: {{ $envolvido['cpf'] }}</p>
        <p>Data de Nascimento: {{ $envolvido['dt_nascimento'] }}</p>
        <p>Nome da mãe: {{ $envolvido['nome_mae'] }} </p>
        <p>Telefone celular: {{ $envolvido['celular'] }}</p>
        <p>Endereço: {{ $envolvido['endereco'] }}</p>
        <div class="divider"></div>
      @endforeach
    </div>
  </li>
  @endif

  @if($ocorrencia['atendimentos'] != null)
  <li>
    <div class="collapsible-header"><i class="material-icons">mode_comment</i>Atendimentos policiais</div>
    <div class="collapsible-body">
      @foreach($ocorrencia['atendimentos'] as $atendimento)
        <p>Responsável: {{ $atendimento['responsavel'] }}</p>
        <p>Data: {{ $atendimento['data'] }}</p>
        <p>Descrição: {{ $atendimento['descricao'] }}</p>
        <div class="divider"></div>
      @endforeach
    </div>
  </li>
  @endif

</ul>
