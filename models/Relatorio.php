<?php
enum GRAVIDADE {
    const NENHUM = 0;
    const RISCO = 1;
    const DESASTRE = 2;
};

enum AREA_AFETADA {
    const INESPECIFICADO = 0;
    const PUBLICA = 1;
    const PARTICULAR = 2;
};

enum TIPO_CONSTRUCAO {
    const INESPECIFICADO = 0;
    const ALVENARIA = 1;
    const MADEIRA = 2;
    const MISTA = 3;
};

enum TIPO_TALUDE {
    const INESPECIFICADO = 0;
    const NATURAL = 1;
    const DE_CORTE = 2;
    const ATERRO = 3;
};

enum VEGETACAO {
    const NENHUMA = 0;
    const RASTEIRA = 1;
    const ARVORES = 2;
};

enum SITUACAO_VITIMAS {
    const INESPECIFICADO = 0;
    const DESABRIGADOS = 1;
    const DESALOJADOS = 2;
};

enum INTERDICAO {
    const NAO = 0;
    const PARCIAL = 1;
    const TOTAL = 2;
};

class Relatorio {
    private int $id;
    private int $idOcorrencia;
    private int $idCasa;
    private int $gravidade;
    private string $relatorio;
    private string $encaminhamento;
    private string $memorando;
    private string $oficio;
    private string $processo;
    private string $assunto;
    private string $observacoes;
    private int $areaAfetada;
    private int $tipoConstrucao;
    private int $tipoTalude;
    private int $vegetacao;
    private int $situacaoVitimas;
    private int $interdicao;
    private int $danosMateriais;
    private string $dataGeracao;
    private string $dataAtendimento;

    // ...

    public function getDanosMateriais(): int {
        return $this->danosMateriais;
    }

    public function setDanosMateriais(int $danosMateriais): void {
        $this->danosMateriais = $danosMateriais;
    }

    // ...

}
?>
