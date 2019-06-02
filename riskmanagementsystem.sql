-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2016 at 08:54 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE `risk` (
  `RiskID` varchar(255) NOT NULL,
  `Obejective` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Division` varchar(255) NOT NULL,
  `Unit` varchar(255) NOT NULL,
  `Cause` varchar(255) NOT NULL,
  `EffectImpact` varchar(255) NOT NULL,
  `AssestmentLikelihood` varchar(255) NOT NULL,
  `AssestmentImpact` varchar(255) NOT NULL,
  `Level` varchar(255) NOT NULL,
  `ExistionCurrentControls` varchar(255) NOT NULL,
  `TreatRisk` varchar(255) NOT NULL,
  `AssessmentLikelihoodResidualRisk` int(255) NOT NULL,
  `AssessmentOfImpactResidualRisk` int(255) NOT NULL,
  `RiskLevelResidual` int(255) NOT NULL,
  `MitigationStrategy` mediumtext NOT NULL,
  `Priorotisation` varchar(255) NOT NULL,
  `LeadResponsibility` varchar(255) NOT NULL,
  `MitigationActionDueDate` mediumtext NOT NULL,
  `TreatmentPlanStatus` varchar(255) NOT NULL,
  `ActionPlan` varchar(255) NOT NULL,
  `ActionPlanStatus` varchar(255) NOT NULL,
  `OriginalLevel` varchar(255) NOT NULL,
  `OriginalDate` varchar(255) NOT NULL,
  `PreviousLevel` varchar(255) NOT NULL,
  `PreviousDate` date NOT NULL,
  `CurrentLevel` varchar(255) NOT NULL,
  `CurrentDate` date NOT NULL,
  `RecordStatus` varchar(255) NOT NULL,
  `DateRegister` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `risk`
--

INSERT INTO `risk` (`RiskID`, `Obejective`, `Category`, `Description`, `Division`, `Unit`, `Cause`, `EffectImpact`, `AssestmentLikelihood`, `AssestmentImpact`, `Level`, `ExistionCurrentControls`, `TreatRisk`, `AssessmentLikelihoodResidualRisk`, `AssessmentOfImpactResidualRisk`, `RiskLevelResidual`, `MitigationStrategy`, `Priorotisation`, `LeadResponsibility`, `MitigationActionDueDate`, `TreatmentPlanStatus`, `ActionPlan`, `ActionPlanStatus`, `OriginalLevel`, `OriginalDate`, `PreviousLevel`, `PreviousDate`, `CurrentLevel`, `CurrentDate`, `RecordStatus`, `DateRegister`) VALUES
('C1', '<p>To comply with applicable laws requiring only licensed software are installed on Corporate PC`s.</p>', 'Environment (ENV-1.0)', '<p>Installation of unlicensed software</p>', 'Corporate Finance Division (CFD)', 'PAMU', '<ol>\r\n<li>User ignorance and unawareness</li>\r\n<li>Lack of sense of ownership</li>\r\n<li>Lack of sense of accountabilty</li>\r\n<li>Users might install unlicensed softwares without prior approval</li>\r\n<li>Vendors might reinstall unlicensed sofwares from the', 'asd', '1', '3', '4', '<ol>\r\n<li>Unlicensed software detected and removed.</li>\r\n<li>Non-job related softwares uninstalled and removed</li>\r\n<li>Assurance of original copy of operating system.</li>\r\n<li>Storage optimitization by discarding unnecessary files.</li>\r\n<li>IT asset&', 'No', 2, 3, 5, '<p style="text-align: left;">Prepare annual IT purchase for Corporate/Divisions /Regional</p>\r\n<p style="text-align: left;">Offices(ROs)through One to One sessions with all divisions(users)</p>\r\n<p style="text-align: left;">conducted on annual basis to de</p>', 'Q1 (Low)', 'Information System officer(ISO)', '<p style="text-align: left;">Prepare annual IT purchase for Corporate/Divisions /Regional</p>\r\n<p style="text-align: left;">Offices(ROs)through One to One sessions with all divisions(users)</p>\r\n<p style="text-align: left;">conducted on annual basis to de</p>', '<p>IT equipment tender process will commence in November 2016</p>', 'Backup on databases are performed everyday', '<p>The 1st IT DR drilll was successfully conducted on 31st July 2015</p>\r\n<p>2nd DR drill will be conducted in December 2015</p>', '1', '31st December 2015', '', '0000-00-00', '1', '2016-02-04', 'Updated\r\n', '31st December 2015'),
('C10', '<p>asd</p>', 'Operational (OP-6.0)', '<p>asd</p>', 'Internal Audit Division (IAD)', 'PAMU', '<p>asd</p>', '<p>asd</p>', '1', '1', '2', '<p>asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'Q1 Low)', 'asd', '2016-02-04', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', 'Q1(Low)', '4th of February 2016', '', '0000-00-00', '', '0000-00-00', '', ''),
('C2', '<p>asd</p>', 'Human Resources (HR-3.0)', '<p>System Development<br /> <br /> Failure to identify accurate /&nbsp; crucial system requirement</p>', 'Information and Communication Division (ICT)', 'Helpdesk Unit', '<p>sad</p>', 'asd', '1', '3', '4', '<p>asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'asd', 'asd', '<p>asd</p>', '<p>as</p>', 'asd', '', '3', '2016-05-05', '', '0000-00-00', '1', '2016-05-05', 'Updated', '12nd January 2016'),
('C3', '<p>To comply with applicable laws requiring only licensed software are installed on Corporate IT equipment</p>', 'Information Technology (IT-4.0)', '<p>Unlicensed software</p>', 'Information and Communication Division (ICT)', 'PAMU', '<ol>\r\n<li>User ignoarance and unawareness.</li>\r\n</ol>', 'Non compliance with BSA ruling', '3', '2', '5', '<ol>\r\n<li>Unlicensed software detected and remove</li>\r\n</ol>', 'Yes', 2, 3, 5, '<ul>\r\n<li>&nbsp;Prepare annual IT purchases for Corporate / Divisions / Regional Offices (ROs) through One to One sessions with all divisions (users) conducted on annual basis to determine their requirement.</li>\r\n<li>Coordinate annual IT purchases for Corporate / Divisions / ROs through tender procedure.</li>\r\n</ul>', 'Q1', 'Q1', '<ul>\r\n<li>&nbsp;Prepare annual IT purchases for Corporate / Divisions / Regional Offices (ROs) through One to One sessions with all divisions (users) conducted on annual basis to determine their requirement.</li>\r\n<li>Coordinate annual IT purchases for Corporate / Divisions / ROs through tender procedure.</li>\r\n</ul>', '<p>ASD</p>', '<p>ASD</p>', '<p>ASD</p>', '1', '2016-02-02', '', '0000-00-00', '1', '2016-02-02', 'Updated\r\n', ''),
('C4', '<p>asd</p>', 'Operational (OP-6.0)', '<p>1. Unauthorised access to SEDC local area network and informaton systems<br /> <br /> 2. Unauthorised use of computers with sensitive / confidential information.</p>', 'Internal Audit Division (IAD)', 'PAMU', '<p>asd</p>', 'asd', '1', '1', '2', '<p>asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'asd', 'asd', '<p>asd</p>', '<p>asda</p>', '<p>asd</p>', '<p>asd</p>', '1', '2016-02-03', '', '0000-00-00', '1', '2016-02-03', 'Updated', ''),
('C5', '<p>asd</p>', 'Operational (OP-6.0)', '<p>Hardware, software, network and website failure</p>', 'Internal Audit Division (IAD)', 'PAMU', '<p>asd</p>', 'asd', '1', '1', '2', '<p>asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'asd', 'asd', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '1', '2016-02-04', '', '0000-00-00', '1', '2016-02-04', '', '3rd of February 2016'),
('C6', '<p>&nbsp;To ensure corporate information stored on servers are backed up daily</p>', 'Information Technology (IT-4.0)', '<p>Timely delivery of Information Systems</p>', 'Information and Communication Division (ICT)', 'Helpdesk Unit', '<p>System Development</p>\r\n<p>Failure to identify accurate / crucial system requirement</p>', 'testing', '2', '2', '4', '<p>1. Unlicensed software detected and removed</p>\r\n<p>2. Non-job related softwares uninstalled and removed</p>\r\n<p>3. Assurance of original copy of operating system</p>\r\n<p>4. Storage optimisation by discarding unnecessary files</p>\r\n<p>5. IT asset track', 'No', 3, 2, 5, '<p>System owner / key user should have a complete documented work process flow.</p>\r\n<p>System owner should be clear on overall manual process</p>\r\n<p>System owner should be able to specify and explain their intended requirements for new system.</p>', 'Q1 (Low)', 'testing', '<p>System owner / key user should have a complete documented work process flow.</p>\r\n<p>System owner should be clear on overall manual process</p>\r\n<p>System owner should be able to specify and explain their intended requirements for new system.</p>', '<p>MedIS New system and old system is on parallel run<br />MIS 1st phase testing stage is in progress<br />Procurement system for HRA, quotation from vendor has been received. Acquirement will probably be in 2016<br />IFCA Loans Plus old database is activ', 'Â test123', '<p>&nbsp;test123</p>', '3', '2015-10-01', '', '0000-00-00', '1', '2015-10-01', '', '4th of February 2016'),
('C7', '<p>&nbsp;To study, recommend, develop and implement work processes automation for SEDC</p>', 'Operational (OP-6.0)', '<p>Timely delivery of Information Systems</p>', 'Information and Communication Division (ICT)', 'Helpdesk Unit', '<p>1. Pre and post development guideline documentation is unavailable<br /> <br /> 2. Project development schedule is unrealistic</p>', '<p>1. Information system does not deliver the desired output<br /> <br /> 2. Project progress is not according to schedule<br /> <br /> 3. Project development consumes resources than budgetted</p>', '2', '1', '3', '<p>1. System and user requirements is finalised and mutually agreed in a requirements sign-off session<br /> <br /> 2. Project developed within stipulated time<br /> <br /> 3. Completed system undergoes user acceptance test to ensure all requirements are<', 'Yes', 1, 1, 2, '<p>1. Activities involved in work processes automation should be clear and scheduled before a project is initiated<br /> <br /> 2. Information Systems Development Guidelines should be established as guidance</p>', 'Q2(Low)', 'Information System Officer', '<p>1. Activities involved in work processes automation should be clear and scheduled before a project is initiated<br /> <br /> 2. Information Systems Development Guidelines should be established as guidance</p>', '<p><span class="font6">Five (5)</span><span class="font5"> systems has been completed. Three (4) systems was completed after revision of completion date. One (1) system was completed ahead of schedule<br /> </span><span class="font6">Four (4)</span>&lt;sp', '<p>Drafting of the Information System Development Guidelines is still in progress</p><p>Â </p><p>A decision paper on Information System Development Guideline will be tabled in the 125<sup>th</sup> MEM in July 2015</p>', '<p>Drafting of the Information System Development Guidelines is still in progress</p>\r\n<p>&nbsp;</p>\r\n<p>A decision paper on Information System Development Guideline will be tabled in the 125<sup>th</sup> MEM in July 2015</p>', '2', '4th of February 2016', '', '0000-00-00', '1', '2015-08-05', '', ''),
('c8', '<p>asd</p>', 'Operational (OP-6.0)', '<p>asd</p>', 'Internal Audit Division (IAD)', 'PAMU', '<p>asd</p>', '<p>asd</p>', '1', '1', '2', '<p>asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'Q1 Low)', 'asd', '2016-02-04', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', 'Q1(Low)', '4th of February 2016', '', '0000-00-00', '', '0000-00-00', '', ''),
('H1', '<p>Objectives :&nbsp; To comply with applicable laws requiring only licensed software are installed on Corporate PC''s.</p>', 'Human Resources (HR-3.0)', '<p>Installation of unlicensed software</p>', 'Human Resource and General Administration Division (HRA)', 'HRMU', '<p>Process owner / System owner / Key users failed to identify core and supplementary system requirements prior to system development</p>', '<p>1. Business discontinuity<br /> <br /> 2. Damaged IT equiment, affecting office productivity<br /> <br /> 3. PCs not updated is exposed to virus / malware attacks<br /> <br /> 4. Unavailability / hacking of website may tarnish corporation''s imageÂ ', '2', '3', '5', '<p>1. Business continuity plan is in place<br /> <br /> 2. IT equipment life span is prolonged due early problem detection<br /> <br /> 3. Software integrity is maintained<br /> <br /> 4. Loop holes and back door in operating system''s is secured thrugh re', 'Yes', 1, 1, 2, '<p>1. User login credentials made mandatory<br /> <br /> 2. Network key to join wireless LAN implemented<br /> <br /> 3. sedc.my Domain Controller enables access to all information systems<br /> <br /> 4. Firewall: Fortigate firewall is on the optimum usage and reports zero unauthorized access attempts from external.<br /> <br /> 5. Introduction of load balancing</p>', 'Q1 Low)', 'Information System Officer', '<p>1. User login credentials made mandatory<br /> <br /> 2. Network key to join wireless LAN implemented<br /> <br /> 3. sedc.my Domain Controller enables access to all information systems<br /> <br /> 4. Firewall: Fortigate firewall is on the optimum usage and reports zero unauthorized access attempts from external.<br /> <br /> 5. Introduction of load balancing</p>', '<p>All preventive maintenance (PM) and housekeeping conducted according to schedule as at June 2015<br /> <br /> PC audit, PM and housekeeping for Menara SEDC will be conducted by the end of July 2015</p>', '<p>testing</p>', '<p>testing</p>', '2', '4th of February 2016', '', '0000-00-00', '1', '2016-02-01', '', ''),
('M5', '<p>asd</p>', 'Operational (OP-6.0)', '<p>Hardware, software, network and website failure</p>', 'Internal Audit Division (IAD)', 'PAMU', '<p>asd</p>', '<p>asd</p>', '1', '1', '2', '<p>&nbsp;asd</p>', 'Yes', 1, 1, 2, '<p>asd</p>', 'Q1()', 'asd', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '1', '4th of February 2016', '', '0000-00-00', '1', '2016-02-04', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NameofDirector` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `AccessLevel` varchar(255) NOT NULL,
  `Division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`ID`, `Name`, `NameofDirector`, `Username`, `Password`, `AccessLevel`, `Division`) VALUES
(1, 'Hj Nor Azlan Husaini', 'Siti Nurazlina Dollah Ahmat Usop', 'Azlan', 'sedc@1234', 'Admin', 'Information and Communication Division (ICT)'),
(2, 'Mohd Irfan', 'Siti Nurazlina Dollah Ahmat Usop', 'irfan', 'sedc@1234', 'Staff', 'Information and Communication Division (ICT)'),
(3, 'Hr', 'Hr', 'Hra', '123456', 'Staff', 'Human Resource and General Administration Division (HRA)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`RiskID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
