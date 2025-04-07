<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiologista', 'description' => 'Cardiologia é a especialidade médica que se ocupa do diagnóstico e tratamento das doenças que acometem o coração bem como os outros componentes do sistema circulatório.'],
            ['name' => 'Psiquiatra', 'description' => 'Psiquiatria é a especialidade médica que trata dos transtornos mentais, emocionais e comportamentais.'],
            ['name' => 'Dermatologista', 'description' => 'Especialista no diagnóstico, tratamento e prevenção de doenças da pele, cabelos e unhas.'],
            ['name' => 'Ortopedista', 'description' => 'Especialidade responsável pelo estudo, diagnóstico e tratamento das doenças e lesões do sistema musculoesquelético.'],
            ['name' => 'Neurologista', 'description' => 'Trata doenças do sistema nervoso, incluindo cérebro, medula espinhal e nervos periféricos.'],
            ['name' => 'Oftalmologista', 'description' => 'Especialista em doenças e cuidados relacionados aos olhos e à visão.'],
            ['name' => 'Otorrinolaringologista', 'description' => 'Trata doenças do ouvido, nariz e garganta.'],
            ['name' => 'Endocrinologista', 'description' => 'Especializado no tratamento de distúrbios hormonais e metabólicos.'],
            ['name' => 'Ginecologista', 'description' => 'Foca na saúde do sistema reprodutor feminino.'],
            ['name' => 'Obstetra', 'description' => 'Especialista em gravidez, parto e pós-parto.'],
            ['name' => 'Pediatra', 'description' => 'Cuida da saúde de crianças e adolescentes.'],
            ['name' => 'Hematologista', 'description' => 'Especialista em doenças do sangue e órgãos hematopoéticos.'],
            ['name' => 'Oncologista', 'description' => 'Diagnóstico e tratamento do câncer.'],
            ['name' => 'Reumatologista', 'description' => 'Trata doenças autoimunes e inflamatórias, como artrite e lúpus.'],
            ['name' => 'Nefrologista', 'description' => 'Especializado em doenças dos rins.'],
            ['name' => 'Urologista', 'description' => 'Trata problemas do trato urinário e do sistema reprodutor masculino.'],
            ['name' => 'Gastroenterologista', 'description' => 'Foca em doenças do aparelho digestivo.'],
            ['name' => 'Hepatologista', 'description' => 'Especialista no fígado e suas doenças.'],
            ['name' => 'Pneumologista', 'description' => 'Cuida das doenças respiratórias, como asma e DPOC.'],
            ['name' => 'Infectologista', 'description' => 'Especializado no tratamento de infecções causadas por vírus, bactérias e fungos.'],
            ['name' => 'Anestesiologista', 'description' => 'Responsável pela anestesia e controle da dor durante procedimentos cirúrgicos.'],
            ['name' => 'Cirurgião Geral', 'description' => 'Especialista em cirurgias abdominais e de emergência.'],
            ['name' => 'Cirurgião Plástico', 'description' => 'Realiza cirurgias estéticas e reconstrutivas.'],
            ['name' => 'Cirurgião Vascular', 'description' => 'Trata doenças das artérias e veias.'],
            ['name' => 'Angiologista', 'description' => 'Especialista em doenças vasculares e linfáticas.'],
            ['name' => 'Proctologista', 'description' => 'Trata doenças do reto e ânus.'],
            ['name' => 'Coloproctologista', 'description' => 'Especializado no tratamento de doenças do intestino grosso, reto e ânus.'],
            ['name' => 'Mastologista', 'description' => 'Foca no diagnóstico e tratamento de doenças da mama.'],
            ['name' => 'Neurocirurgião', 'description' => 'Especialista em cirurgias do sistema nervoso central e periférico.'],
            ['name' => 'Radiologista', 'description' => 'Responsável pela interpretação de exames de imagem.'],
            ['name' => 'Patologista', 'description' => 'Diagnostica doenças através da análise laboratorial de tecidos e células.'],
            ['name' => 'Geneticista', 'description' => 'Especializado no estudo de doenças genéticas e hereditárias.'],
            ['name' => 'Alergologista', 'description' => 'Trata doenças alérgicas, como rinite e asma.'],
            ['name' => 'Imunologista', 'description' => 'Especialista no sistema imunológico e doenças autoimunes.'],
            ['name' => 'Fisiatra', 'description' => 'Trata pacientes com deficiências físicas e reabilitação.'],
            ['name' => 'Geriatra', 'description' => 'Foca na saúde dos idosos.'],
            ['name' => 'Clínico Geral', 'description' => 'Atende diversas doenças e faz encaminhamentos a especialistas.'],
            ['name' => 'Nutrólogo', 'description' => 'Especialista em nutrição clínica e doenças relacionadas à alimentação.'],
            ['name' => 'Médico do Esporte', 'description' => 'Foca na saúde e desempenho de atletas e praticantes de atividades físicas.'],
            ['name' => 'Homeopata', 'description' => 'Utiliza medicamentos homeopáticos para tratar doenças.'],
            ['name' => 'Medicina do Trabalho', 'description' => 'Cuida da saúde ocupacional e prevenção de doenças relacionadas ao trabalho.'],
            ['name' => 'Medicina de Família', 'description' => 'Atua na prevenção e cuidados gerais da saúde da família.'],
            ['name' => 'Medicina Intensiva', 'description' => 'Especialista no atendimento de pacientes graves em UTI.'],
            ['name' => 'Medicina Nuclear', 'description' => 'Utiliza substâncias radioativas para diagnóstico e tratamento de doenças.'],
            ['name' => 'Radioterapeuta', 'description' => 'Especialista no tratamento de câncer com radiação.'],
            ['name' => 'Sexólogo', 'description' => 'Trata disfunções e distúrbios sexuais.'],
            ['name' => 'Medicina Legal', 'description' => 'Atua na perícia médica em casos judiciais.'],
            ['name' => 'Toxicologista', 'description' => 'Estuda e trata intoxicações por substâncias químicas.'],
            ['name' => 'Dermatopatologista', 'description' => 'Especialista em diagnósticos de doenças de pele por meio de biópsias.']
        ];

        foreach ($specialties as $specialty){
            Specialty::create($specialty);
        }
    }
}
