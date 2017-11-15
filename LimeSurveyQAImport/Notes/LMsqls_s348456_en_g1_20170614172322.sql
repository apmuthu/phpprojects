
INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 1, 'random_order', '1', NULL), (NULL, 1, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (1, 0, 348456, 1, 'L', 'BEL001', 'A Digital Ohmmeter is being use to measure a component. The meter indicates 3.725K ohms. This indicates', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (1, 'A1', '3,725 ohms', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (1, 'A2', '0.3725 ohms', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (1, 'A3', '3.725 ohms', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (1, 'A4', '3,725,000 ohms', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 2, 'random_order', '1', NULL), (NULL, 2, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (2, 0, 348456, 1, 'L', 'BEL002', 'Oscilloscopes can be used to', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (2, 'A1', 'A - view the shape of voltage waveforms', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (2, 'A2', 'B - measure voltage over a period of time', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (2, 'A3', 'Both A and B', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (2, 'A4', 'Measure resistance', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 3, 'random_order', '1', NULL), (NULL, 3, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (3, 0, 348456, 1, 'L', 'BEL003', 'When using an ammeter to measure current', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (3, 'A1', 'open the circuit and connect the meter in series between the two open ends.', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (3, 'A2', 'open the circuit at one point and connect the meter to one end.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (3, 'A3', 'open the circuit at the positive and negative terminals of the battery.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (3, 'A4', 'connect the meter across the battery or load.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 4, 'random_order', '1', NULL), (NULL, 4, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (4, 0, 348456, 1, 'L', 'BEL004', 'What is the color code for a 220 Ohms 5% resistor?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (4, 'A1', 'Red, Red, Brown, Gold', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (4, 'A2', 'Orange, Orange, Black, Gold', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (4, 'A3', 'Red, Red, Black, Gold', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (4, 'A4', 'Red, Red, Brown, Silver', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 5, 'random_order', '1', NULL), (NULL, 5, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (5, 0, 348456, 1, 'L', 'BEL005', 'Before connecting an ohmmeter to a circuit, you should first', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (5, 'A1', 'Check the circuit with a voltmeter to make sure the circuit is not powered', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (5, 'A2', 'Operate the circuit.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (5, 'A3', 'Set the range selector to the highest range.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (5, 'A4', 'Install new batteries.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 6, 'random_order', '1', NULL), (NULL, 6, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (6, 0, 348456, 1, 'L', 'BEL006', 'A possible cause of an open circuit would be', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (6, 'A1', 'All of these', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (6, 'A2', 'A loose component mount.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (6, 'A3', 'A corroded connection.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (6, 'A4', 'A pin pushed out of a connector', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 7, 'random_order', '1', NULL), (NULL, 7, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (7, 0, 348456, 1, 'L', 'BEL007', 'When checking a normally open relay (with four terminals) with and ohmmeter, no continuity will be shown between two terminals and the other two terminals will show', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (7, 'A1', 'Resistance somewhere between 40 ohms and 120 ohms.', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (7, 'A2', 'No continuity.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (7, 'A3', 'About 2000 ohms.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (7, 'A4', 'Perfect continuity (0 ohms).', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 8, 'random_order', '1', NULL), (NULL, 8, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (8, 0, 348456, 1, 'L', 'BEL008', 'To measure the voltage drop of a connector, the volt meter should be connected', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (8, 'A1', 'in parallel, across each side of the connector', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (8, 'A2', 'in series, between the connector and the battery.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (8, 'A3', 'in series, between the connector and the circuit load', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (8, 'A4', 'in parallel, between the connector and the battery.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 9, 'random_order', '1', NULL), (NULL, 9, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (9, 0, 348456, 1, 'L', 'BEL009', 'With all accessories turned off, the current (Parasitic) drain on the battery should be', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (9, 'A1', 'under 35 milliamperes.', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (9, 'A2', 'zero.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (9, 'A3', 'under 3 amperes.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (9, 'A4', 'under 100 milliamperes.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 10, 'random_order', '1', NULL), (NULL, 10, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (10, 0, 348456, 1, 'L', 'BEL010', 'Technician A says that a digital meter is preferred to an analog meter when measuring sensitive computer circuits. Technician B says that an analog meter might overload a computer circuit. Who is correct?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (10, 'A1', 'Both Technicians A and B.', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (10, 'A2', 'Technician A only.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (10, 'A3', 'Technician B only.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (10, 'A4', 'Neither Technicians A nor B.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 11, 'random_order', '1', NULL), (NULL, 11, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (11, 0, 348456, 1, 'L', 'BEL011', 'Two technicians are discussing a 25% duty cycle of an electrical cooling fan. Technician A says the pulse width is 25% measured in hertz. Technican B says this indicates the fan in ON 25% and off 75% OFF the time.', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (11, 'A1', 'Technician B only', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (11, 'A2', 'Technician A only.', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (11, 'A3', 'Neither Technicians A nor B.', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (11, 'A4', 'Both Technicians A and B.', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 12, 'random_order', '1', NULL), (NULL, 12, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (12, 0, 348456, 1, 'L', 'BEL012', 'A 4-bit R/2R digital-to-analog (DAC) converter has a reference of 10 volts. What is the analog output for the input code 0101', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (12, 'A1', '3.125 V', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (12, 'A2', '0.3125 V', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (12, 'A3', '-3.125 V', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (12, 'A4', '0.78125 V', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 13, 'random_order', '1', NULL), (NULL, 13, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (13, 0, 348456, 1, 'L', 'BEL013', 'The range of an 8-bit twos complement word is from', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (13, 'A1', '-128<sub>10</sub> to +127<sub>10</sub>', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (13, 'A2', '+128<sub>10</sub> to -128<sub>10</sub>', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (13, 'A3', '+127<sub>10</sub> to -127<sub>10</sub>', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (13, 'A4', '+127<sub>10</sub> to -128<sub>10</sub>', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 14, 'random_order', '1', NULL), (NULL, 14, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (14, 0, 348456, 1, 'L', 'BEL014', 'What is the next step after discovering a faulty gate within an IC?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (14, 'A1', 'replace the IC involved', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (14, 'A2', 'repair the gate', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (14, 'A3', 'resolder the tracks', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (14, 'A4', 'recheck the power source', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 15, 'random_order', '1', NULL), (NULL, 15, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (15, 0, 348456, 1, 'L', 'BEL015', 'A digital logic device used as a buffer should have what input/output characteristics?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (15, 'A1', 'high input impedance and low output impedance', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (15, 'A2', 'high input impedance and high output impedance', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (15, 'A3', 'low input impedance and high output impedance', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (15, 'A4', 'low input impedance and low output impedance', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 16, 'random_order', '1', NULL), (NULL, 16, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (16, 0, 348456, 1, 'L', 'BEL016', 'Which digital IC package type makes the most efficient use of printed circuit board space?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (16, 'A1', 'SMD', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (16, 'A2', 'TO can', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (16, 'A3', 'flat pack', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (16, 'A4', 'DIP', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 17, 'random_order', '1', NULL), (NULL, 17, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (17, 0, 348456, 1, 'L', 'BEL017', 'CMOS logic is probably the best all-around circuitry because of its', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (17, 'A1', 'low power consumption and very high noise immunity', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (17, 'A2', 'packing density', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (17, 'A3', 'low power consumption', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (17, 'A4', 'very high noise immunity', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 18, 'random_order', '1', NULL), (NULL, 18, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (18, 0, 348456, 1, 'L', 'BEL018', 'A TTL totem pole circuit is designed so that the output transistors are', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (18, 'A1', 'never on together', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (18, 'A2', 'always on together', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (18, 'A3', 'providing phase splitting', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (18, 'A4', 'providing voltage regulation', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 19, 'random_order', '1', NULL), (NULL, 19, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (19, 0, 348456, 1, 'L', 'BEL019', 'The main factor, which differentiates a D-MOSFET from an E-MOSFET, in the absence of', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (19, 'A1', 'channel', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (19, 'A2', 'PN junction', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (19, 'A3', 'insulated gate', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (19, 'A4', 'electrons', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 20, 'random_order', '1', NULL), (NULL, 20, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (20, 0, 348456, 1, 'L', 'BEL020', 'Which JFET configuration would connect a high-resistance signal source to a low-resistance load?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (20, 'A1', 'source follower', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (20, 'A2', 'common-source', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (20, 'A3', 'common-drain', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (20, 'A4', 'common-gate', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 21, 'random_order', '1', NULL), (NULL, 21, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (21, 0, 348456, 1, 'L', 'BEL021', 'With a JFET, a ratio of output current change against an input voltage change is called', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (21, 'A1', 'Transconductance', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (21, 'A2', 'Seimens', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (21, 'A3', 'Resistivity', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (21, 'A4', 'Gain', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 22, 'random_order', '1', NULL), (NULL, 22, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (22, 0, 348456, 1, 'L', 'BEL022', 'The only way to close an SCR is with', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (22, 'A1', 'Forward breakover voltage', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (22, 'A2', 'A trigger input applied to the gate', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (22, 'A3', 'Reverse voltage', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (22, 'A4', 'Low-current dropout', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 23, 'random_order', '1', NULL), (NULL, 23, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (23, 0, 348456, 1, 'L', 'BEL023', 'What type of application would use a photovoltaic cell?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (23, 'A1', 'a remote power source', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (23, 'A2', 'an automobile horn', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (23, 'A3', 'a TI 92 calculator', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (23, 'A4', 'a magnetic field detector', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 24, 'random_order', '1', NULL), (NULL, 24, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (24, 0, 348456, 1, 'L', 'BEL024', 'Once a DIAC is conducting, the only way to turn it off is with', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (24, 'A1', 'low-current dropout', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (24, 'A2', 'a positive gate voltage', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (24, 'A3', 'a negative gate voltage', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (24, 'A4', 'breakover Voltage', 4, 0, 'en', 0);

INSERT INTO sdom_question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES (NULL, 25, 'random_order', '1', NULL), (NULL, 25, 'random_group', '1', NULL);
INSERT INTO sdom_questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (25, 0, 348456, 1, 'L', 'BEL025', 'What type of application would use an injection laser diode?', '', '', 'N', 'N', 1,'en', 0, 0, '1');
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (25, 'A1', 'a fiber optic transmission line', 1, 1, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (25, 'A2', 'a 10 BASE-T Ethernet', 2, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (25, 'A3', 'a liquid crystal display', 3, 0, 'en', 0);
INSERT INTO sdom_answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (25, 'A4', 'a good flashlight', 4, 0, 'en', 0);
