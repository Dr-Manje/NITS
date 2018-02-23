-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2017 at 09:22 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nancy`
--
CREATE DATABASE IF NOT EXISTS `nancy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nancy`;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `activitiesID` int(11) NOT NULL AUTO_INCREMENT,
  `activitiesname` varchar(255) DEFAULT NULL,
  `activitiesdescription` varchar(255) DEFAULT NULL,
  `activitytypeID` int(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  PRIMARY KEY (`activitiesID`),
  KEY `activitytypef_idx` (`activitytypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `activitydetails`
--

CREATE TABLE IF NOT EXISTS `activitydetails` (
  `activityDetailsID` int(11) NOT NULL AUTO_INCREMENT,
  `headOfActivity` varchar(250) DEFAULT NULL,
  `activityID` int(11) DEFAULT NULL,
  `regYear` int(11) DEFAULT NULL,
  PRIMARY KEY (`activityDetailsID`),
  KEY `regyeayactivity_idx` (`regYear`),
  KEY `activityref_idx` (`activityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `activitytype`
--

CREATE TABLE IF NOT EXISTS `activitytype` (
  `activitytypeID` int(11) NOT NULL AUTO_INCREMENT,
  `activitytypename` varchar(255) DEFAULT NULL,
  `activitytypedescription` varchar(255) DEFAULT NULL,
  `code` int(2) DEFAULT NULL,
  PRIMARY KEY (`activitytypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `advance`
--

CREATE TABLE IF NOT EXISTS `advance` (
  `advanceid` int(11) NOT NULL AUTO_INCREMENT,
  `advanceAmount` varchar(255) DEFAULT NULL,
  `advanceType` int(11) DEFAULT NULL,
  `IPC` int(11) DEFAULT NULL,
  `MarketCenter` int(11) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `advanceDate` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`advanceid`),
  KEY `IPCadvanceRef_idx` (`IPC`),
  KEY `MKCadvanceRef_idx` (`MarketCenter`),
  KEY `SeasonAdvanceRef_idx` (`season`),
  KEY `CreatedByAdvanceRef_idx` (`createdBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `associations`
--

CREATE TABLE IF NOT EXISTS `associations` (
  `associationsID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `associationsDescription` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `fieldref` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`associationsID`),
  KEY `ipc_idx` (`fieldref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE IF NOT EXISTS `buyers` (
  `buyersid` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `marketcenter` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `buyercode` varchar(45) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`buyersid`),
  KEY `marketcenterref_idx` (`marketcenter`),
  KEY `buyerseasonref_idx` (`season`),
  KEY `buyersseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `casualworkers`
--

CREATE TABLE IF NOT EXISTS `casualworkers` (
  `casualworkersid` int(11) NOT NULL AUTO_INCREMENT,
  `casualworkercode` varchar(255) DEFAULT NULL,
  `names` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`casualworkersid`),
  KEY `warehousecasualworker_idx` (`warehouse`),
  KEY `cwseasonref_idx` (`season`),
  KEY `casualworkerseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `clubsID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `clubDescription` varchar(255) DEFAULT NULL,
  `fieldref` int(11) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clubsID`),
  KEY `GACref_idx` (`fieldref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `codereference`
--

CREATE TABLE IF NOT EXISTS `codereference` (
  `coderefid` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) DEFAULT NULL,
  `prefix` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`coderefid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coderegister`
--

CREATE TABLE IF NOT EXISTS `coderegister` (
  `coderegisterid` int(11) NOT NULL AUTO_INCREMENT,
  `coderef` int(11) DEFAULT NULL,
  `counter` int(100) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`coderegisterid`),
  KEY `coderef_idx` (`coderef`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cropmarketing`
--

CREATE TABLE IF NOT EXISTS `cropmarketing` (
  `cropmarketingID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) DEFAULT NULL,
  `cropID` int(11) DEFAULT NULL,
  `receiptnumber` varchar(255) DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `totalvalue` decimal(19,2) DEFAULT NULL,
  `membershipStatus` int(1) DEFAULT NULL,
  `regYearID` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `nonemembername` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cropmarketingID`),
  KEY `membercropff_idx` (`memberID`),
  KEY `cropmarketingf_idx` (`cropID`),
  KEY `cropmarkitingYearf_idx` (`regYearID`),
  KEY `createdbyuser_idx` (`createdby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE IF NOT EXISTS `crops` (
  `cropID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `cropdescription` varchar(45) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cropID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

CREATE TABLE IF NOT EXISTS `dispatch` (
  `dispatchid` int(11) NOT NULL AUTO_INCREMENT,
  `dispatchdate` datetime DEFAULT NULL,
  `dispatchdeparture` int(11) DEFAULT NULL,
  `dispatchdestination` int(11) DEFAULT NULL,
  `cg7_Sent` varchar(255) DEFAULT NULL,
  `chalim_sent` varchar(255) DEFAULT NULL,
  `cg7_received` varchar(255) DEFAULT NULL,
  `chalim_received` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`dispatchid`),
  KEY `destinationref_idx` (`dispatchdestination`),
  KEY `departureref_idx` (`dispatchdeparture`),
  KEY `seasondispatchref_idx` (`season`),
  KEY `dispatchseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dispatchlocations`
--

CREATE TABLE IF NOT EXISTS `dispatchlocations` (
  `dispatchbuyersid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(45) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dispatchbuyersid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `districtID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldcode` varchar(255) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `districtPrefix` int(3) DEFAULT NULL,
  `fieldref` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`districtID`),
  KEY `IPCrefNew_idx` (`fieldref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `districtsregyear`
--

CREATE TABLE IF NOT EXISTS `districtsregyear` (
  `districtsregyearID` int(11) NOT NULL AUTO_INCREMENT,
  `IPC` int(11) DEFAULT NULL,
  `regyear` int(11) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `NIS` int(1) DEFAULT NULL,
  PRIMARY KEY (`districtsregyearID`),
  KEY `reagyearref23_idx` (`regyear`),
  KEY `districtref23_idx` (`IPC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE IF NOT EXISTS `donors` (
  `donorsid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`donorsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gac`
--

CREATE TABLE IF NOT EXISTS `gac` (
  `GACid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `GAC_desc` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `fieldref` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`GACid`),
  KEY `assID_idx` (`fieldref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE IF NOT EXISTS `grading` (
  `gradingid` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `variety` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`gradingid`),
  KEY `gradeseasonref_idx` (`season`),
  KEY `gradewarehouseref_idx` (`warehouse`),
  KEY `gradingseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `handsorting`
--

CREATE TABLE IF NOT EXISTS `handsorting` (
  `handsortingid` int(11) NOT NULL AUTO_INCREMENT,
  `casualworker` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `variety` varchar(45) DEFAULT NULL,
  `gradeouts` varchar(45) DEFAULT NULL,
  `shells` varchar(45) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`handsortingid`),
  KEY `casualworkerref_idx` (`casualworker`),
  KEY `seasonsortingref_idx` (`season`),
  KEY `sortingseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ipc`
--

CREATE TABLE IF NOT EXISTS `ipc` (
  `IPCid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `IPC_desc` varchar(255) DEFAULT NULL,
  `IPC_status` varchar(45) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `fieldref` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IPCid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE IF NOT EXISTS `livestock` (
  `livestockID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `livestockdescription` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`livestockID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marketcenter`
--

CREATE TABLE IF NOT EXISTS `marketcenter` (
  `marketcenterid` int(11) NOT NULL AUTO_INCREMENT,
  `regyear` int(11) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `mpa` decimal(19,2) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`marketcenterid`),
  KEY `regyearmarketref_idx` (`regyear`),
  KEY `mkcseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marketcentermembers`
--

CREATE TABLE IF NOT EXISTS `marketcentermembers` (
  `marketcentermembersid` int(11) NOT NULL AUTO_INCREMENT,
  `marketcenterid` int(11) DEFAULT NULL,
  `gacid` int(11) DEFAULT NULL,
  PRIMARY KEY (`marketcentermembersid`),
  KEY `gacref_idx` (`gacid`),
  KEY `marketcenterref_idx` (`marketcenterid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memberactivities`
--

CREATE TABLE IF NOT EXISTS `memberactivities` (
  `memberactivitiesID` int(11) NOT NULL AUTO_INCREMENT,
  `activitiesID` int(11) DEFAULT NULL,
  `involved` varchar(5) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  `numberoftrees` int(11) DEFAULT NULL,
  `treettype` int(11) DEFAULT NULL,
  PRIMARY KEY (`memberactivitiesID`),
  KEY `memberactivityf_idx` (`memberID`),
  KEY `activitymemberfff_idx` (`activitiesID`),
  KEY `treetyperef1_idx` (`treettype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `membercrops`
--

CREATE TABLE IF NOT EXISTS `membercrops` (
  `cropinformationID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) DEFAULT NULL,
  `cropID` int(11) DEFAULT NULL,
  `acreage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cropinformationID`),
  KEY `membercropf_idx` (`memberID`),
  KEY `cropmemeberf_idx` (`cropID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memberlivestock`
--

CREATE TABLE IF NOT EXISTS `memberlivestock` (
  `memberslivestockID` int(11) NOT NULL AUTO_INCREMENT,
  `livestockID` int(11) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`memberslivestockID`),
  KEY `memberlivestockf_idx` (`memberID`),
  KEY `livestockmemberf_idx` (`livestockID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `membernumberreg`
--

CREATE TABLE IF NOT EXISTS `membernumberreg` (
  `membernumberregID` int(11) NOT NULL AUTO_INCREMENT,
  `memberNumber` varchar(45) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  `memberCounter` int(11) DEFAULT NULL,
  `districtID` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`membernumberregID`),
  KEY `memberNumbers_idx` (`memberID`),
  KEY `districts_idx` (`districtID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `membernumberregister`
--

CREATE TABLE IF NOT EXISTS `membernumberregister` (
  `memberNumber` varchar(15) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  KEY `districtmemberref_idx` (`district`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `yearRegistered` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `hhSize` int(11) DEFAULT NULL,
  `club` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `ta` varchar(255) DEFAULT NULL,
  `gac` varchar(255) DEFAULT NULL,
  `gvh` varchar(255) DEFAULT NULL,
  `village` int(11) DEFAULT NULL,
  `association` int(11) DEFAULT NULL,
  `tccregno` varchar(255) DEFAULT NULL,
  `gendervcat` varchar(255) DEFAULT NULL,
  `cropsales` decimal(15,2) DEFAULT NULL,
  `othersources` decimal(15,2) DEFAULT NULL,
  `nomonthswithfood` int(2) DEFAULT NULL,
  `copingmechanism` varchar(255) DEFAULT NULL,
  `comments` mediumtext,
  `memberNumber` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `ftype` varchar(255) DEFAULT NULL,
  `rtype` varchar(255) DEFAULT NULL,
  `wtype` varchar(255) DEFAULT NULL,
  `identificationNo` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`memberID`),
  KEY `year_idx` (`yearRegistered`),
  KEY `villageF_idx` (`village`),
  KEY `clubRef_idx` (`club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memberyearreg`
--

CREATE TABLE IF NOT EXISTS `memberyearreg` (
  `memberyearregID` int(11) NOT NULL AUTO_INCREMENT,
  `yearregID` int(11) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  `memberNumber` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`memberyearregID`),
  KEY `meberegf_idx` (`memberID`),
  KEY `yearregfff_idx` (`yearregID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nisdistricts`
--

CREATE TABLE IF NOT EXISTS `nisdistricts` (
  `nisdistrictsid` int(11) NOT NULL,
  `district` int(11) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  PRIMARY KEY (`nisdistrictsid`),
  KEY `nisdistrictref_idx` (`district`),
  KEY `nisregyearref_idx` (`season`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement`
--

CREATE TABLE IF NOT EXISTS `procurement` (
  `procurementid` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(255) DEFAULT NULL,
  `membertype` int(11) DEFAULT NULL,
  `membername` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `moisture` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `mwk` decimal(15,2) DEFAULT NULL,
  `marketcenter` int(11) DEFAULT NULL,
  `memberid` int(11) DEFAULT NULL,
  `regyear` int(11) DEFAULT NULL,
  PRIMARY KEY (`procurementid`),
  KEY `marketcenterprocref_idx` (`marketcenter`),
  KEY `memberrefproc_idx` (`memberid`),
  KEY `procurementrefyear_idx` (`regyear`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `purchasesid` int(11) NOT NULL AUTO_INCREMENT,
  `receipt` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `buyer` int(11) DEFAULT NULL,
  `member` int(11) DEFAULT NULL,
  `farmer` varchar(255) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `farmerstatus` varchar(45) DEFAULT NULL,
  `crop` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `cum` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `mwk` varchar(45) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `ipc` int(11) DEFAULT NULL,
  PRIMARY KEY (`purchasesid`),
  KEY `buyerref_idx` (`buyer`),
  KEY `memberpurchase_idx` (`member`),
  KEY `croppurchaseref_idx` (`crop`),
  KEY `seasonref_idx` (`season`),
  KEY `purchaseseasonref_idx` (`ipc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registrationyear`
--

CREATE TABLE IF NOT EXISTS `registrationyear` (
  `regyearID` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `season` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `procurementAmount` decimal(19,2) DEFAULT NULL,
  PRIMARY KEY (`regyearID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seeddistribution`
--

CREATE TABLE IF NOT EXISTS `seeddistribution` (
  `seeddistributionID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) DEFAULT NULL,
  `acquiredseedID` int(11) DEFAULT NULL,
  `acquiredseedkgs` int(11) DEFAULT NULL,
  `repaidseedID` int(11) DEFAULT NULL,
  `repaidseedkgs` int(11) DEFAULT NULL,
  `repaidcropID` int(11) DEFAULT NULL,
  `repaidcropkgs` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `regYearID` int(11) DEFAULT NULL,
  `repaymentMode` varchar(10) DEFAULT NULL,
  `donor` int(11) DEFAULT NULL,
  PRIMARY KEY (`seeddistributionID`),
  KEY `memberseedF_idx` (`memberID`),
  KEY `acquiredseed_idx` (`acquiredseedID`),
  KEY `repaidseed_idx` (`repaidseedID`),
  KEY `repaidcrop_idx` (`repaidcropID`),
  KEY `regYearSeedDistribution_idx` (`regYearID`),
  KEY `donor_idx` (`donor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seeds`
--

CREATE TABLE IF NOT EXISTS `seeds` (
  `seedID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `seeddescription` varchar(45) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seedID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE IF NOT EXISTS `targets` (
  `targetsID` int(11) NOT NULL AUTO_INCREMENT,
  `regYear` int(11) DEFAULT NULL,
  `targettype` varchar(255) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  PRIMARY KEY (`targetsID`),
  KEY `regyeartarget_idx` (`regYear`),
  KEY `activitytargetref_idx` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `treeplantingitems`
--

CREATE TABLE IF NOT EXISTS `treeplantingitems` (
  `treeplantingitemsid` int(11) NOT NULL AUTO_INCREMENT,
  `memberactivityid` int(11) DEFAULT NULL,
  `treetype` int(11) DEFAULT NULL,
  `numberoftrees` int(5) DEFAULT NULL,
  `treedetails` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`treeplantingitemsid`),
  KEY `memberactivityref_idx` (`memberactivityid`),
  KEY `treeref_idx` (`treetype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE IF NOT EXISTS `trees` (
  `treesid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `treesdescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`treesid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL,
  `IPC` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  KEY `usertyperef_idx` (`usertype`),
  KEY `userIPCref_idx` (`IPC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstname`, `lastname`, `status`, `usertype`, `IPC`) VALUES
(1, 'admin@nasfam.org', 'pass', 'admin', 'admin', 'ACTIVE', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `usertypesid` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`usertypesid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`usertypesid`, `usertype`, `description`) VALUES
(1, 'Admin', NULL),
(2, 'Regular', NULL),
(3, 'HQ Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE IF NOT EXISTS `village` (
  `villageID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) DEFAULT NULL,
  `villageHeadman` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`villageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
  `warehouseid` int(11) NOT NULL AUTO_INCREMENT,
  `regyear` int(11) DEFAULT NULL,
  `IPC` int(11) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldcode` varchar(255) DEFAULT NULL,
  `marketcenter` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`warehouseid`),
  KEY `warehouseregyearref_idx` (`regyear`),
  KEY `warehouseipcref_idx` (`IPC`),
  KEY `marketcenterref_idx` (`marketcenter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activitytypef` FOREIGN KEY (`activitytypeID`) REFERENCES `activitytype` (`activitytypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `activitydetails`
--
ALTER TABLE `activitydetails`
  ADD CONSTRAINT `activityref` FOREIGN KEY (`activityID`) REFERENCES `activities` (`activitiesID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `regyeayactivity` FOREIGN KEY (`regYear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `advance`
--
ALTER TABLE `advance`
  ADD CONSTRAINT `IPCadvanceRef` FOREIGN KEY (`IPC`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MKCadvanceRef` FOREIGN KEY (`MarketCenter`) REFERENCES `marketcenter` (`marketcenterid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `SeasonAdvanceRef` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CreatedByAdvanceRef` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `associations`
--
ALTER TABLE `associations`
  ADD CONSTRAINT `ipc` FOREIGN KEY (`fieldref`) REFERENCES `districts` (`districtID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `marketcenterbuyerref` FOREIGN KEY (`marketcenter`) REFERENCES `marketcenter` (`marketcenterid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buyerseasonref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buyersseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `casualworkers`
--
ALTER TABLE `casualworkers`
  ADD CONSTRAINT `warehousecasualworker` FOREIGN KEY (`warehouse`) REFERENCES `warehouse` (`warehouseid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cwseasonref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `casualworkerseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `GACref` FOREIGN KEY (`fieldref`) REFERENCES `gac` (`GACid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coderegister`
--
ALTER TABLE `coderegister`
  ADD CONSTRAINT `coderef` FOREIGN KEY (`coderef`) REFERENCES `codereference` (`coderefid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cropmarketing`
--
ALTER TABLE `cropmarketing`
  ADD CONSTRAINT `membercropff` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cropmarketingf` FOREIGN KEY (`cropID`) REFERENCES `crops` (`cropID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cropmarkitingYearf` FOREIGN KEY (`regYearID`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `createdbyuser` FOREIGN KEY (`createdby`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dispatch`
--
ALTER TABLE `dispatch`
  ADD CONSTRAINT `departureref` FOREIGN KEY (`dispatchdeparture`) REFERENCES `dispatchlocations` (`dispatchbuyersid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `destinationref` FOREIGN KEY (`dispatchdestination`) REFERENCES `dispatchlocations` (`dispatchbuyersid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seasondispatchref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dispatchseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `IPCrefNew` FOREIGN KEY (`fieldref`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `districtsregyear`
--
ALTER TABLE `districtsregyear`
  ADD CONSTRAINT `districtref23` FOREIGN KEY (`IPC`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reagyearref23` FOREIGN KEY (`regyear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gac`
--
ALTER TABLE `gac`
  ADD CONSTRAINT `assID` FOREIGN KEY (`fieldref`) REFERENCES `associations` (`associationsID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grading`
--
ALTER TABLE `grading`
  ADD CONSTRAINT `gradewarehouseref` FOREIGN KEY (`warehouse`) REFERENCES `warehouse` (`warehouseid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gradeseasonref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gradingseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `handsorting`
--
ALTER TABLE `handsorting`
  ADD CONSTRAINT `casualworkerref` FOREIGN KEY (`casualworker`) REFERENCES `casualworkers` (`casualworkersid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seasonsortingref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sortingseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `marketcenter`
--
ALTER TABLE `marketcenter`
  ADD CONSTRAINT `regyearmarketref` FOREIGN KEY (`regyear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mkcseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `marketcentermembers`
--
ALTER TABLE `marketcentermembers`
  ADD CONSTRAINT `marketcenterref111` FOREIGN KEY (`marketcenterid`) REFERENCES `marketcenter` (`marketcenterid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gacref1231` FOREIGN KEY (`gacid`) REFERENCES `gac` (`GACid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memberactivities`
--
ALTER TABLE `memberactivities`
  ADD CONSTRAINT `memberactivityf` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `activitymemberfff` FOREIGN KEY (`activitiesID`) REFERENCES `activities` (`activitiesID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `treetyperef1` FOREIGN KEY (`treettype`) REFERENCES `trees` (`treesid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `membercrops`
--
ALTER TABLE `membercrops`
  ADD CONSTRAINT `membercropf` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cropmemeberf` FOREIGN KEY (`cropID`) REFERENCES `crops` (`cropID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memberlivestock`
--
ALTER TABLE `memberlivestock`
  ADD CONSTRAINT `memberlivestockf` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `livestockmemberf` FOREIGN KEY (`livestockID`) REFERENCES `livestock` (`livestockID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `membernumberreg`
--
ALTER TABLE `membernumberreg`
  ADD CONSTRAINT `memberNumbers` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `districts` FOREIGN KEY (`districtID`) REFERENCES `districts` (`districtID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `membernumberregister`
--
ALTER TABLE `membernumberregister`
  ADD CONSTRAINT `districtmemberref` FOREIGN KEY (`district`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `year` FOREIGN KEY (`yearRegistered`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `villageF` FOREIGN KEY (`village`) REFERENCES `village` (`villageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `clubRef` FOREIGN KEY (`club`) REFERENCES `clubs` (`clubsID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memberyearreg`
--
ALTER TABLE `memberyearreg`
  ADD CONSTRAINT `yearregfff` FOREIGN KEY (`yearregID`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `memberegf` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nisdistricts`
--
ALTER TABLE `nisdistricts`
  ADD CONSTRAINT `nisdistrictref` FOREIGN KEY (`district`) REFERENCES `districts` (`districtID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nisregyearref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `procurement`
--
ALTER TABLE `procurement`
  ADD CONSTRAINT `marketcenterprocref` FOREIGN KEY (`marketcenter`) REFERENCES `marketcenter` (`marketcenterid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `memberrefproc` FOREIGN KEY (`memberid`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `procurementrefyear` FOREIGN KEY (`regyear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `buyerref` FOREIGN KEY (`buyer`) REFERENCES `buyers` (`buyersid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `memberpurchase` FOREIGN KEY (`member`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `croppurchaseref` FOREIGN KEY (`crop`) REFERENCES `crops` (`cropID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seasonref` FOREIGN KEY (`season`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchaseseasonref` FOREIGN KEY (`ipc`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seeddistribution`
--
ALTER TABLE `seeddistribution`
  ADD CONSTRAINT `memberseedF` FOREIGN KEY (`memberID`) REFERENCES `members` (`memberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `acquiredseed` FOREIGN KEY (`acquiredseedID`) REFERENCES `seeds` (`seedID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `repaidseed` FOREIGN KEY (`repaidseedID`) REFERENCES `seeds` (`seedID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `repaidcrop` FOREIGN KEY (`repaidcropID`) REFERENCES `crops` (`cropID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `regYearSeedDistribution` FOREIGN KEY (`regYearID`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `donor` FOREIGN KEY (`donor`) REFERENCES `donors` (`donorsid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `regyeartarget` FOREIGN KEY (`regYear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `activitytargetref` FOREIGN KEY (`item`) REFERENCES `activities` (`activitiesID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `treeplantingitems`
--
ALTER TABLE `treeplantingitems`
  ADD CONSTRAINT `memberactivityref` FOREIGN KEY (`memberactivityid`) REFERENCES `memberactivities` (`memberactivitiesID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `treeref` FOREIGN KEY (`treetype`) REFERENCES `trees` (`treesid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usertyperef` FOREIGN KEY (`usertype`) REFERENCES `usertypes` (`usertypesid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userIPCref` FOREIGN KEY (`IPC`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouseregyearref` FOREIGN KEY (`regyear`) REFERENCES `registrationyear` (`regyearID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `warehouseipcref` FOREIGN KEY (`IPC`) REFERENCES `ipc` (`IPCid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `marketcenterref` FOREIGN KEY (`marketcenter`) REFERENCES `marketcenter` (`marketcenterid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
