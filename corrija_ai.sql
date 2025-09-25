-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/09/2025 às 14:26
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `corrija_ai`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `redacoes`
--

DROP TABLE IF EXISTS `redacoes`;
CREATE TABLE IF NOT EXISTS `redacoes` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_id` int NOT NULL,
  `aluno_nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `texto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_envio` datetime NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pendente',
  `c1` int DEFAULT '0',
  `c2` int DEFAULT '0',
  `c3` int DEFAULT '0',
  `c4` int DEFAULT '0',
  `c5` int DEFAULT '0',
  `nota_final` int DEFAULT '0',
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pontos_fortes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pontos_melhoria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `redacoes`
--

INSERT INTO `redacoes` (`id`, `usuario_id`, `aluno_nome`, `tema`, `titulo`, `texto`, `data_envio`, `status`, `c1`, `c2`, `c3`, `c4`, `c5`, `nota_final`, `comentarios`, `pontos_fortes`, `pontos_melhoria`) VALUES
('redacao_68d543beb6e254.93642046', 4, 'Lorena', 'Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil', '', 'Durante o Período Colonial, houve a estruturação da família brasileira baseada em valores patriarcais, segundo a qual restringia o papel da mulher à reprodução e aos afazeres domésticos. Porém, apesar da passagem do tempo, percebe-se que esses valores se aplicam na realidade contemporânea, uma vez que, de acordo com o Instituto Brasileiro de Geografia e Estatística (IBGE), a média de horas semanais dedicadas às tarefas de cuidado realizadas por mulheres no Brasil são, quase o dobro, em comparação às realizadas por homens. Nesse viés, é crucial apontar a negligência governamental e o descaso populacional como motivadores desse revés, a fim de elencar medidas para resolver o impasse. \r\nA princípio, pode-se afirmar que o governo é ineficaz em relação ao combate da invisibilidade do trabalho realizado pela mulher no Brasil. Segundo a Constituição Federal de 1988, “todos são iguais perante a lei”. Entretanto, ao se analisar a diferença alarmante entre o número de homens e de mulheres que realizam essas tarefas, percebe-se que essa prerrogativa não tem se cumprido na prática com eficácia. Além disso, em todo o mundo existem casos em que o trabalho de cuidado é mal pago ou não é remunerado, assumido especialmente por mulheres em situação de pobreza. Logo, é comprovada a negligência do governo, uma vez que este não dá a devida atenção ao assunto.\r\nAdemais, outro fator crucial para a continuidade do problema é o descaso dado pela sociedade ao assunto, tendo em vista que esta se mantém apática perante a situação, sem procurar meios para resolvê-la, como a aplicação de campanhas referentes ao tema. O conceito “A Banalidade do Mal”, da filosofa Hannah Arendt, afirma que o pior mal é aquele visto como algo cotidiano. Assim, visto que a falta de visibilidade do trabalho de cuidado realizado pela mulher é recorrente e não afeta parte da população, esta banaliza a situação, tornando o cenário invisível.\r\nPortanto, a partir dos fatos citados, torna-se necessária a implementação de medidas para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil. Dessa forma, o Governo Federal, órgão responsável por assegurar o bem-estar social, deve organizar e aplicar ajuda financeira, através de auxílios, para as mulheres que realizam as tarefas de cuidado e, infelizmente, são pouco remuneradas, com a intenção de proporcionar melhores perspectivas de vida e, em consequência, diminuir a desigualdade sofrida por estas. Bem como, cabe a sociedade criar campanhas sobre o assunto para, assim, torná-lo visível.', '2025-09-25 00:00:00', 'corrigida', 160, 200, 200, 200, 200, 960, 'A redação apresenta uma discussão pertinente e bem estruturada sobre a invisibilidade do trabalho de cuidado realizado pelas mulheres no Brasil. O texto demonstra domínio da norma culta, articulação coesa entre os parágrafos e uso adequado de repertórios socioculturais. Além disso, a proposta de intervenção é pertinente, detalhada e atende aos critérios exigidos pelo ENEM. Bom uso da linguagem formal, com pequenos deslizes.', 'Temática bem compreendida: Demonstra entendimento do tema proposto e consegue discorrer sobre ele com clareza e profundidade.\r\nBoa estrutura argumentativa: O texto segue a estrutura clássica da dissertação: introdução com contextualização histórica, desenvolvimento com dois argumentos bem delineados e conclusão com proposta de intervenção. \r\nCoesão textual: O uso de conectivos está adequado e facilita a progressão das ideias.\r\nProposta de intervenção completa: A proposta apresentada na conclusão contempla o agente (Governo Federal e sociedade), a ação (ajuda financeira e campanhas), o meio e a finalidade, o que atende plenamente ao esperado pela competência 5 da redação do ENEM.', 'Cuidado com generalizações:\r\nExpressões como \"a sociedade se mantém apática\", embora compreensíveis, soam generalizantes. Talvez suavizar para \"grande parte da sociedade\" ou \"uma parcela significativa da população\" seria mais adequado.'),
('redacao_68d54c029decc1.47670561', 6, 'Paola', 'Desafios para combater a aporofobia no Brasil', '', 'A novela brasileira “Carrossel”, exibida pelo SBT, narra a história de uma escola de ensino fundamental e a vida de seus alunos. A obra retrata o relacionamento das personagens Maria Joaquina e Cirilo, no qual a garota o despreza por sua condição financeira. De forma análoga, a ficção condiz com a realidade brasileira, visto que o preconceito com pessoas em situação de pobreza é recorrente em nosso país. Nesse viés, é crucial apontar a negligência governamental e o descaso populacional como motivadores desse revés, a fim de elencar medidas para resolver o impasse.\r\nA princípio, pode-se afirmar que o governo é negligente com a população, uma vez que a aporofobia não é considerada crime no Brasil. Desse modo, comprovam-se as teorias de Achille Mbembe, filósofo camaronês, o qual cunhou o termo “Necropolítica”, alegando que o estado cria zonas de morte, selecionando os que devem viver e os que devem morrer, favorecendo aqueles que, de alguma forma, trazem retorno financeiro a ele. Logo, o grupo formado pelos pobres, não recebe apoio dos governantes do país, haja vista serem considerados prejuízos, comprovando a teoria da negligência. \r\nAdemais, outro fator fundamental para continuidade do problema é o descaso dado pela sociedade ao assunto, tendo em vista que esta se mantém apática perante a situação, sem procurar meios para resolvê-la, como a aplicação de campanhas sociais referentes ao tema. O conceito “A Banalidade do Mal”, da filosofa Hannah Arendt, afirma que o pior mal é aquele visto como algo cotidiano. Assim, visto que a aporofobia é recorrente e não prejudica diretamente parte da sociedade, esta banaliza a situação, tornando o cenário invisível.\r\nPortanto, é necessário estabelecer medidas para combater o preconceito com pessoas em situação de pobreza em nosso país. Dessa forma, o Governo Federal, órgão responsável por assegurar o bem-estar social, deve implementar políticas públicas, por meio de leis e de ações governamentais, a fim de diminuir o número de casos de aporofobia no Brasil. Além disso, a população deve mobilizar-se perante a situação, criando campanhas sociais sobre o assunto, com a intenção de dar visibilidade a este e, assim, combatê-lo.', '2025-09-25 00:00:00', 'corrigida', 200, 200, 200, 200, 200, 1000, 'A redação apresenta uma estrutura sólida, com introdução, desenvolvimento e conclusão bem organizados. Há um bom domínio da norma-padrão da língua portuguesa e o uso de repertórios socioculturais pertinentes — como a novela Carrossel, a teoria da Necropolítica de Mbembe e A Banalidade do Mal, de Hannah Arendt — é um ponto alto do texto.', 'Clareza e coesão textual:\r\nA redação é fluida, com bons conectivos e progressão lógica das ideias. A transição entre os parágrafos é natural e coerente.\r\n\r\nRepertório sociocultural pertinente e bem aplicado:\r\nO uso de Carrossel é criativo e gera identificação.\r\nA Necropolítica, de Achille Mbembe, foi bem relacionada à negligência estatal, apesar de precisar de ajustes (ver abaixo).\r\nHannah Arendt é um repertório clássico muito valorizado, especialmente pela forma como foi aplicado à indiferença social.\r\n\r\nEstrutura dissertativo-argumentativa completa:\r\nO texto segue a estrutura esperada pelo ENEM: introdução com tese clara, dois parágrafos de desenvolvimento e uma conclusão com proposta de intervenção.', 'Generalizações e falta de aprofundamento em algumas afirmações:\r\nFrases como “o grupo formado pelos pobres não recebe apoio dos governantes” são muito generalistas. É importante demonstrar quais políticas faltam, ou que tipo de ausência o texto está denunciando (assistência, saúde, moradia, educação?).\r\n\r\nProposta de intervenção genérica:\r\n\r\nA proposta atende aos cinco elementos exigidos pelo ENEM (agente, ação, modo, efeito e detalhamento), mas de forma superficial.\r\nExpressões como “implementar políticas públicas” e “ações governamentais” são vagas. Quais políticas? Programas educacionais? Legislação específica? Reformas sociais? Faltou especificidade e viabilidade.'),
('redacao_68d54cc458dc78.74720653', 6, 'Paola', 'Desafios para o uso indiscriminado do celular em sala de aula', '', 'De acordo com a Constituição Federal de 1988, todos têm direito à educação. Porém, ao se observar o cenário do uso indiscriminado do celular em sala de aula, percebe-se que essa prerrogativa não tem se cumprido na prática, uma vez que o uso do aparelho impacta negativamente o aprendizado e a concentração dos alunos. Nesse viés, é crucial apontar a insuficiência governamental e o descaso populacional como motivadores desse revés. \r\n   A princípio, pode-se afirmar que o governo é ineficaz com relação ao uso inapropriado do celular em ambiente escolar, visto que não aplica a fiscalização adequada neste. Dessa forma, observa-se a comprovação das teorias de Gilberto Dimenstein, jornalista brasileiro, o qual criou o termo “Cidadania de Papel”, referindo-se ao fato de que os direitos são garantidos somente na teoria - no papel - sem, portanto, serem válidos na prática. Desse modo, ao se observar o abuso do celular em sala de aula, percebe-se que existem leis para impedir a situação, porém não são aplicadas com eficácia. Assim, o governo negligência a população ao não exercer suas obrigações com o regulamento.\r\n   Além disso, o descaso populacional é outro fato fundamental para a continuidade do problema, uma vez que a sociedade se mantém indiferente perante a situação, sem procurar meios para resolvê-la, como aplicar campanhas de conscientização referentes ao tema. O conceito “A Banalidade do Mal”, da filósofa Hannah Arendt, afirma que o pior mal é aquele visto como algo cotidiano. Logo, visto que o uso indiscriminado do celular em sala de aula é frequente e não afeta diretamente parte da sociedade, esta banaliza a situação, tornando o cenário invisível.\r\n   Portanto, é fundamental implantar medidas para combater o uso inapropriado do celular em ambiente escolar, visto que este prejudica o aprendizado e a concentração dos alunos em sala de aula. Dessa maneira, o Governo Federal, órgão responsável por assegurar o bem-estar social, deve aplicar melhor fiscalização nas escolas, contratando profissionais especializados, a fim de diminuir ou erradicar o uso indiscriminado do aparelho. Ademais, cabe à sociedade contribuir com a conscientização do problema por meio de campanhas, para que as pessoas possam compreendê-lo e, assim, tentar mudar o cenário atual.', '2025-09-25 00:00:00', 'pendente', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
('redacao_68d54efd797aa5.79246196', 5, 'João', 'Desafios para a valorização da herança africana no Brasil', '', 'A obra “Utopia”, do escritor Thomas More, retrata uma sociedade perfeita, isenta de problemas e de conflitos. Contudo, ao se comparar com o cenário contemporâneo, percebe-se o oposto ao contexto da obra, uma vez que a desvalorização da herança africana em nosso país gera barreiras que dificultam a concretização dos planos de More, caracterizando uma distopia moderna. Nesse viés, é crucial apontar a falta de abordagem do assunto pelas escolas e a banalização do problema por parte da sociedade como motivadores desse revés. \r\n      A princípio, pode-se afirmar que a falta de abordagem do assunto pelas escolas é um fator crucial para a continuidade do problema, gerando desconhecimento social sobre este.  Nesse sentido, Paulo Freire, renomado pedagogo, afirma em sua obra “Pedagogia do oprimido”, que o ensino das escolas brasileiras é bancário, ou seja, estas se preocupam somente em depositar conhecimentos aos alunos, com exames e vestibulares, de forma conteudista, sem abordar pautas como a desvalorização da herança africana no Brasil e suas consequências. Desse modo, as pessoas poderiam desenvolver senso crítico para compreender e, inclusive, mudar o cenário. \r\n      Além disso, a banalização do problema por parte da sociedade se torna outro fator crucial para tal desvalorização. O conceito “A Banalidade do Mal”, imposto pela filósofa Hannah Arendt, afirma que o pior mal é aquele visto como algo cotidiano. Assim, visto que a desvalorização da herança africana é algo frequente e não prejudica diretamente parte da sociedade, esta banaliza a situação, tornando o cenário invisível.\r\n      Portanto, é de suma importância a valorização da herança africana em nosso país. Assim, é dever do Ministério da Educação e Cultura (MEC), responsável pela educação brasileira, implementar conteúdo, por meio de aulas e palestras, sobre a valorização da cultura africana, para que os alunos possam adquirir maior conhecimento sobre o assunto. Além disso, a sociedade deve aplicar campanhas públicas referentes ao tema a fim de conscientizar as pessoas sobre este e, assim, tentar mudar o cenário atual.', '2025-09-25 00:00:00', 'pendente', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `is_admin`) VALUES
(3, 'Paola', 'paoladgasparii.pdg@gmail.com', '$2y$10$42sGyrSGBakkkp5th9YfWuIVVaMNuUDqfggfYmcERz07JH7qPHUSq', '2025-08-14 17:39:06', 1),
(4, 'Lorena', 'lorena123@gmail.com', '$2y$10$IQbK/2CcDLzX01zb4xs3X.1pB5p4qscRu6ePGJ3pPcEF6qVmlp3JW', '2025-09-11 17:51:01', 0),
(5, 'João Francisco', 'joao12345@gmail.com', '$2y$10$3NHHG//Ju3ocCTvVySQY/ehKVKLoczq88DKAL1BMTHQY.EI0q4UoW', '2025-09-24 14:28:28', 0),
(6, 'Paola', 'paola123@gmail.com', '$2y$10$NFHKScY437.ZsQLdRSqwL.f1QL6QfF3hK.7sDkEQAnUtH38doc09O', '2025-09-25 14:00:19', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
