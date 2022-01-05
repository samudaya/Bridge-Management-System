
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `bms`
--


CREATE TABLE IF NOT EXISTS `--bms_spansurfacetype` (
  `SpanSurfaceTypeID` int(7) NOT NULL AUTO_INCREMENT,
  `SpanSurface` varchar(200) NOT NULL,
  PRIMARY KEY (`SpanSurfaceTypeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bms_abutmentfoundationmaterials`
--

CREATE TABLE IF NOT EXISTS `bms_abutmentfoundationmaterials` (
  `AbutmentFoundationMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `AbutmentFoundationMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`AbutmentFoundationMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bms_abutmentfoundationmaterials`
--

INSERT INTO `bms_abutmentfoundationmaterials` (`AbutmentFoundationMaterialID`, `AbutmentFoundationMaterial`) VALUES
(1, 'Prestressed Concrete'),
(2, 'RC'),
(3, 'Concrete'),
(4, 'Steel'),
(5, 'Timber');

CREATE TABLE IF NOT EXISTS `bms_abutmentfoundations` (
  `AbutmentFoundationID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `AbutmentNumber` int(2) NOT NULL,
  `abutmentfoundationtypes_AbutmentFoundationTypeID` int(11) NOT NULL,
  `abutmentfoundationmaterials_AbutmentFoundationMaterialID` int(7) NOT NULL,
  `Comments` varchar(500) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AbutmentFoundationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=389 ;



CREATE TABLE IF NOT EXISTS `bms_abutmentfoundationtypes` (
  `AbutmentFoundationTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `AbutmentFoundationType` varchar(200) NOT NULL,
  PRIMARY KEY (`AbutmentFoundationTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_abutmentfoundationtypes` (`AbutmentFoundationTypeID`, `AbutmentFoundationType`) VALUES
(1, 'Spread Footing'),
(2, 'Piles'),
(3, 'Cylinders'),
(4, 'Reinforced Earth');



CREATE TABLE IF NOT EXISTS `bms_abutmentmaterials` (
  `AbutmentMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `AbutmentMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`AbutmentMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `bms_abutmentmaterials` (`AbutmentMaterialID`, `AbutmentMaterial`) VALUES
(1, 'RC'),
(2, 'Mass Concrete'),
(3, 'Stone'),
(4, 'Steel');


CREATE TABLE IF NOT EXISTS `bms_abutments` (
  `AbutmentID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `AbutmentNumber` int(2) NOT NULL,
  `abutmenttypes_AbutmentTypeID` int(11) NOT NULL,
  `abutmentmaterials_AbutmentMaterialID` int(7) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AbutmentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=389 ;


CREATE TABLE IF NOT EXISTS `bms_abutmenttypes` (
  `AbutmentTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `AbutmentType` varchar(200) NOT NULL,
  PRIMARY KEY (`AbutmentTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `bms_abutmenttypes` (`AbutmentTypeID`, `AbutmentType`) VALUES
(1, 'Cantilevered'),
(2, 'Gravity Abutment'),
(3, 'Stub Abutment'),
(4, 'Counter Fort'),
(5, 'Reinforce Eearth'),
(6, 'Frame');


CREATE TABLE IF NOT EXISTS `bms_attachmentslocations` (
  `AttachmentsLocationsID` int(7) NOT NULL AUTO_INCREMENT,
  `AttachmentsLocations` varchar(200) NOT NULL,
  PRIMARY KEY (`AttachmentsLocationsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bms_attachmentslocations`
--

INSERT INTO `bms_attachmentslocations` (`AttachmentsLocationsID`, `AttachmentsLocations`) VALUES
(1, 'LHS'),
(2, 'RHS');


CREATE TABLE IF NOT EXISTS `bms_barrierlocations` (
  `BarrierLocationsID` int(7) NOT NULL AUTO_INCREMENT,
  `BarrierLocations` varchar(50) NOT NULL,
  PRIMARY KEY (`BarrierLocationsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;


CREATE TABLE IF NOT EXISTS `bms_barriertypes` (
  `BarrierTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `BarrierType` varchar(200) NOT NULL,
  PRIMARY KEY (`BarrierTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `bms_barriertypes` (`BarrierTypeID`, `BarrierType`) VALUES
(1, 'Rigid'),
(2, 'Semi Rigid'),
(3, 'Flexible');


CREATE TABLE IF NOT EXISTS `bms_bearingmaterials` (
  `BearingMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `BearingMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`BearingMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `bms_bearingmaterials` (`BearingMaterialID`, `BearingMaterial`) VALUES
(1, 'Elastomeric'),
(2, 'Steel'),
(3, 'Concrete');


CREATE TABLE IF NOT EXISTS `bms_bearingtypes` (
  `BearingTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `BearingType` varchar(200) NOT NULL,
  PRIMARY KEY (`BearingTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `bms_bearingtypes` (`BearingTypeID`, `BearingType`) VALUES
(1, 'Plain'),
(2, 'Laminated'),
(3, 'Fixed'),
(4, 'Sliding');



CREATE TABLE IF NOT EXISTS `bms_bridgeprofileattachments` (
  `BridgeProfileAttachmentID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `CadDesign1Name` varchar(200) NOT NULL,
  `CadDesign2Name` varchar(200) NOT NULL,
  `CadDesign3Name` varchar(200) NOT NULL,
  `CadDesign4Name` varchar(200) NOT NULL,
  `CadDesign5Name` varchar(200) NOT NULL,
  `CadDesign1Dis` varchar(200) NOT NULL,
  `CadDesign2Dis` varchar(200) NOT NULL,
  `CadDesign3Dis` varchar(200) NOT NULL,
  `CadDesign4Dis` varchar(200) NOT NULL,
  `CadDesign5Dis` varchar(200) NOT NULL,
  `Drawing1Name` varchar(200) NOT NULL,
  `Drawing2Name` varchar(200) NOT NULL,
  `Drawing3Name` varchar(200) NOT NULL,
  `Drawing4Name` varchar(200) NOT NULL,
  `Drawing5Name` varchar(200) NOT NULL,
  `Drawing6Name` varchar(200) NOT NULL,
  `Drawing7Name` varchar(200) NOT NULL,
  `Drawing8Name` varchar(200) NOT NULL,
  `Drawing9Name` varchar(200) NOT NULL,
  `Drawing10Name` varchar(200) NOT NULL,
  `Drawing1Dis` varchar(200) NOT NULL,
  `Drawing2Dis` varchar(200) NOT NULL,
  `Drawing3Dis` varchar(200) NOT NULL,
  `Drawing4Dis` varchar(200) NOT NULL,
  `Drawing5Dis` varchar(200) NOT NULL,
  `Drawing6Dis` varchar(200) NOT NULL,
  `Drawing7Dis` varchar(200) NOT NULL,
  `Drawing8Dis` varchar(200) NOT NULL,
  `Drawing9Dis` varchar(200) NOT NULL,
  `Drawing10Dis` varchar(200) NOT NULL,
  `Image1Name` varchar(200) NOT NULL,
  `Image2Name` varchar(200) NOT NULL,
  `Image3Name` varchar(200) NOT NULL,
  `Image4Name` varchar(200) NOT NULL,
  `Image5Name` varchar(200) NOT NULL,
  `Image1Dis` varchar(200) NOT NULL,
  `Image2Dis` varchar(200) NOT NULL,
  `Image3Dis` varchar(200) NOT NULL,
  `Image4Dis` varchar(200) NOT NULL,
  `Image5Dis` varchar(200) NOT NULL,
  `Other1Dis` varchar(200) NOT NULL,
  `Other2Dis` varchar(200) NOT NULL,
  `Other3Dis` varchar(200) NOT NULL,
  `Other4Dis` varchar(200) NOT NULL,
  `Other5Dis` varchar(200) NOT NULL,
  `Other1Name` varchar(200) NOT NULL,
  `Other2Name` varchar(200) NOT NULL,
  `Other3Name` varchar(200) NOT NULL,
  `Other4Name` varchar(200) NOT NULL,
  `Other5Name` varchar(200) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BridgeProfileAttachmentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;


CREATE TABLE IF NOT EXISTS `bms_bridgeprofiles` (
  `BridgeProfileID` int(11) NOT NULL AUTO_INCREMENT,
  `StructureID` varchar(20) NOT NULL,
  `sections_SectionID` int(11) NOT NULL DEFAULT '1',
  `BridgeName` varchar(200) NOT NULL,
  `owners_OwnerID` int(7) NOT NULL,
  `roadnames_RoadNameID` int(7) NOT NULL,
  `---operationalstatuses_OperationalStatusID` int(11) NOT NULL,
  `UnderPassRoad` varchar(200) NOT NULL,
  `OverPassRoad` varchar(200) NOT NULL,
  `RiverName` varchar(200) NOT NULL,
  `routenos_RouteNoID` int(11) NOT NULL,
  `roadclasses_RoadClassID` int(11) NOT NULL,
  `railroadnames_RailRoadID` int(7) NOT NULL,
  `structuretypes_StructureTypeID` int(7) NOT NULL,
  `funcofbridges_FuncOfBridgeID` int(11) NOT NULL,
  `constructionmaterials_ConstructionMaterialID` int(7) NOT NULL,
  `YearOfConstructionStart` int(4) NOT NULL,
  `YearOfConstructionEnd` int(4) NOT NULL,
  `district_DistrictID` int(11) NOT NULL,
  `provinces_ProvinceID` int(11) NOT NULL,
  `EEDivision` varchar(200) NOT NULL,
  `ClosestTown` varchar(200) NOT NULL,
  `StartChainage` double(20,2) NOT NULL,
  `EndChainage` double(20,2) NOT NULL,
  `GazettedLength` double(20,2) NOT NULL,
  `GPSCoordinateN` varchar(200) NOT NULL,
  `GPSCoordinateE` varchar(200) NOT NULL,
  `GPSCoordinateZ` varchar(200) NOT NULL,
  `designstandards_DesignStandardID` int(7) NOT NULL,
  `DesignLoading` double(10,2) NOT NULL,
  `StructureLength` decimal(10,2) NOT NULL,
  `StructureWidth` double(10,2) NOT NULL,
  `NoOfSpans` int(3) NOT NULL,
  `NoOfPiers` int(7) NOT NULL,
  `CarriagewayWidth` double(10,2) NOT NULL,
  `NoOfLanes` int(2) NOT NULL,
  `LaneWidth` double(10,2) NOT NULL,
  `FootPathWidthLeft` double(10,2) NOT NULL DEFAULT '0.00',
  `FootPathWidthRight` double(10,2) NOT NULL DEFAULT '0.00',
  `MedianWidth` double(10,2) NOT NULL,
  `MedianHeight` double(10,2) NOT NULL,
  `SuperStructure_barriertypes` int(11) NOT NULL,
  `SuperStructure_BarrierNumber` int(11) NOT NULL,
  `BarrierWidth` double(10,2) NOT NULL,
  `BarrierHeight` double(10,2) NOT NULL,
  `RoadApproachAlignmentVertical` double(10,3) NOT NULL,
  `RoadApproachAlignmentHorizontal` double(10,3) NOT NULL,
  `spantypes_SpanTypeID` int(7) NOT NULL,
  `SkewAngle` varchar(200) NOT NULL,
  `barriertypes_ASBarrierTypeID` int(7) NOT NULL,
  `barrierlocations_ASBarrierLocationsID` int(7) NOT NULL,
  `HeightInvertBridgeUnderside` double(10,3) NOT NULL,
  `HeightOWLBridgeUnderside` double(10,3) NOT NULL,
  `HighestFloodLevelBridgeUnderside` double(10,3) NOT NULL,
  `HighestFloodLevelDate` date NOT NULL,
  `NormalFloodLevelBridgeUnderside` double(10,3) NOT NULL,
  `HeadRoom` double(10,3) NOT NULL,
  `Navigable` double(10,3) NOT NULL,
  `InitialSignedClearance` double(10,3) NOT NULL,
  `GrossLoadLimit` double(10,3) NOT NULL,
  `PostedLoadLimit` double(10,3) NOT NULL,
  `AADT` int(11) NOT NULL,
  `Detours` int(11) NOT NULL,
  `HeavyVehicle` double(10,3) NOT NULL,
  `AttachmentsServices` varchar(200) NOT NULL,
  `AttachmentsDetails` varchar(200) NOT NULL,
  `attachmentslocations_AttachmentsLocationsID` int(7) NOT NULL,
  `NumberOfLampPosts` int(20) NOT NULL,
  `bearingtypes_BearingTypeID` int(11) NOT NULL,
  `bearingtypes_BearingMaterialID` int(11) NOT NULL,
  `ExpansionJointsType` varchar(200) NOT NULL,
  `climatezones_ClimateZoneID` int(7) NOT NULL,
  `localenvironments_LocalEnvironmentID` int(7) NOT NULL,
  `exposureclasses_ExposureClassID` int(7) NOT NULL,
  `ProtectiveCoatings` text NOT NULL,
  `Contamination` text NOT NULL,
  `Comments` text NOT NULL,
  `Active` enum('0','1') NOT NULL DEFAULT '1',
  `economicsfactors_EconomicsFactorID` int(11) NOT NULL,
  `loadingfactors_LoadingFactorID` int(11) NOT NULL,
  `ParapetLeftParapetTypeID` int(11) NOT NULL,
  `ParapetLeftLenth` decimal(6,3) NOT NULL,
  `ParapetRIghtParapetTypeID` int(11) NOT NULL,
  `ParapetRIghtLenth` decimal(6,3) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`BridgeProfileID`),
  UNIQUE KEY `StructureID` (`StructureID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;


CREATE TABLE IF NOT EXISTS `bms_climatezones` (
  `ClimateZoneID` int(5) NOT NULL AUTO_INCREMENT,
  `ClimateZone` varchar(200) NOT NULL,
  PRIMARY KEY (`ClimateZoneID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_climatezones` (`ClimateZoneID`, `ClimateZone`) VALUES
(1, 'Dry Zone'),
(2, 'Wet Zone'),
(3, 'Arid Zone'),
(4, 'Intermediate Zone');



CREATE TABLE IF NOT EXISTS `bms_constructionmaterials` (
  `ConstructionMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `ConstructionMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`ConstructionMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `bms_constructionmaterials` (`ConstructionMaterialID`, `ConstructionMaterial`) VALUES
(1, 'Steel'),
(2, 'Concrete'),
(3, 'Bricks'),
(4, 'Timber'),
(5, 'Metal'),
(6, 'Metal and Concrete'),
(7, 'Bricks and Concrete');


CREATE TABLE IF NOT EXISTS `bms_deckmaterials` (
  `DeckMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `DeckMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`DeckMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_deckmaterials` (`DeckMaterialID`, `DeckMaterial`) VALUES
(1, 'PSC Slab'),
(2, 'RC Slab'),
(3, 'Steel'),
(4, 'Timber'),
(5, 'Other');


CREATE TABLE IF NOT EXISTS `bms_decks` (
  `DeckID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `YearOfConstruction` int(4) NOT NULL,
  `DeckNumber` int(3) NOT NULL,
  `DeckSurfaceThickness` double(10,2) NOT NULL,
  `deckmaterials_DeckMaterialID` int(11) NOT NULL,
  `desksurfacetypes_DeskSurfaceTypeID` int(7) NOT NULL,
  `Original` enum('o','w') NOT NULL DEFAULT 'o',
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`DeckID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=362 ;

CREATE TABLE IF NOT EXISTS `bms_designstandards` (
  `DesignStandardID` int(5) NOT NULL AUTO_INCREMENT,
  `DesignStandard` varchar(200) NOT NULL,
  PRIMARY KEY (`DesignStandardID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `bms_designstandards` (`DesignStandardID`, `DesignStandard`) VALUES
(1, 'BS'),
(2, 'EURO Code'),
(3, 'AASHTO'),
(4, 'Austroads'),
(5, 'Japanese Code'),
(6, 'Other');


CREATE TABLE IF NOT EXISTS `bms_desksurfacetypes` (
  `DeskSurfaceTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `DeskSurfaceType` varchar(200) NOT NULL,
  PRIMARY KEY (`DeskSurfaceTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



INSERT INTO `bms_desksurfacetypes` (`DeskSurfaceTypeID`, `DeskSurfaceType`) VALUES
(1, 'Asphalt'),
(2, 'Bitument surface'),
(3, 'Concrete'),
(4, 'Other');


CREATE TABLE IF NOT EXISTS `bms_districts` (
  `DistrictID` int(11) NOT NULL AUTO_INCREMENT,
  `District` varchar(200) NOT NULL,
  `provinces_ProvinceID` int(11) NOT NULL,
  PRIMARY KEY (`DistrictID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;



CREATE TABLE IF NOT EXISTS `bms_economicsfactors` (
  `EconomicsFactorID` int(5) NOT NULL AUTO_INCREMENT,
  `EconomicsFactorName` varchar(200) NOT NULL,
  `EconomicsFactor` double(10,3) NOT NULL,
  PRIMARY KEY (`EconomicsFactorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_economicsfactors` (`EconomicsFactorID`, `EconomicsFactorName`, `EconomicsFactor`) VALUES
(1, '0-5B', 1.000),
(2, '5B-25B', 2.000),
(3, '25B-50B', 3.000),
(4, '50B-100B', 4.000),
(5, '>100B', 5.000);


CREATE TABLE IF NOT EXISTS `bms_eedivisions` (
  `EEDdivisionID` int(11) NOT NULL AUTO_INCREMENT,
  `EEDdivision` varchar(200) NOT NULL,
  `district_DistrictID` int(11) NOT NULL,
  `provinces_ProvinceID` int(11) NOT NULL,
  PRIMARY KEY (`EEDdivisionID`),
  UNIQUE KEY `EEDdivision` (`EEDdivision`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `bms_exposureclasses` (
  `ExposureClassID` int(5) NOT NULL AUTO_INCREMENT,
  `ExposureClass` varchar(200) NOT NULL,
  PRIMARY KEY (`ExposureClassID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_exposureclasses` (`ExposureClassID`, `ExposureClass`) VALUES
(1, '4 - Extreme'),
(2, '3 - Very Severe'),
(3, '2 - Severe'),
(4, '1 - Moderate');


CREATE TABLE IF NOT EXISTS `bms_funcofbridges` (
  `FuncOfBridgeID` int(11) NOT NULL AUTO_INCREMENT,
  `FuncOfBridge` varchar(200) NOT NULL,
  PRIMARY KEY (`FuncOfBridgeID`),
  UNIQUE KEY `FuncOfBridge` (`FuncOfBridge`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `bms_funcofbridges` (`FuncOfBridgeID`, `FuncOfBridge`) VALUES
(1, 'Bridge Over River'),
(2, 'Under Pass'),
(3, 'Over Pass'),
(4, 'Cattle Crossing'),
(5, 'Road Over Rail'),
(6, 'Pedestrian Bridge'),
(7, 'Culvert');


CREATE TABLE IF NOT EXISTS `bms_inspection1datas` (
  `Inspection1DataID` int(11) NOT NULL AUTO_INCREMENT,
  `bms_inspection1headerdatas_Inspection1HeaderDataID` int(11) NOT NULL,
  `bms_inspection1secondaryinfos_Inspection1SecondaryInfoID` int(11) NOT NULL,
  `ijkval` int(11) NOT NULL,
  `Problem` enum('y','n','-') NOT NULL DEFAULT '-',
  `Comment` text NOT NULL,
  `Rectified` enum('y','n','-') NOT NULL DEFAULT '-',
  `MaintainaceRequired` enum('y','n','-') DEFAULT '-',
  `InspectionRequired` enum('y','n','-') NOT NULL DEFAULT '-',
  PRIMARY KEY (`Inspection1DataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=415 ;


CREATE TABLE IF NOT EXISTS `bms_inspection1headerdatas` (
  `Inspection1HeaderDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `InspectionDate` date NOT NULL,
  `NextInspectionDate` date NOT NULL,
  `Level1Inspection` enum('p','e') NOT NULL DEFAULT 'p',
  `GeneralComment` text NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Inspection1HeaderDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;



CREATE TABLE IF NOT EXISTS `bms_inspection1masterinfos` (
  `Inspection1MasterInfoID` int(7) NOT NULL,
  `Inspection1MasterInfo` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `bms_inspection1masterinfos` (`Inspection1MasterInfoID`, `Inspection1MasterInfo`) VALUES
(1, 'Signs and Delineation'),
(2, 'Guardrail'),
(3, 'Road Drainage'),
(4, 'Road Surface'),
(5, 'Bridge Surface'),
(6, 'Footpaths'),
(7, 'Barriers'),
(8, 'Expansion Joints'),
(9, 'Waterway General'),
(10, 'Material Defects in Substructure'),
(11, 'Substructure General'),
(12, 'Bearings'),
(13, 'Material Defects in Superstructure'),
(14, 'Superstructure General'),
(15, 'Damage to Services'),
(16, 'Roadway under Bridge'),
(17, 'Material Defects in Culverts');


CREATE TABLE IF NOT EXISTS `bms_inspection1secondaryinfos` (
  `Inspection1SecondaryInfoID` int(7) NOT NULL,
  `inspection1masterinfos_Inspection1MasterInfoID` int(7) NOT NULL,
  `Inspection1SecondaryInfo` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `bms_inspection1secondaryinfos` (`Inspection1SecondaryInfoID`, `inspection1masterinfos_Inspection1MasterInfoID`, `Inspection1SecondaryInfo`) VALUES
(1, 1, 'Missing, Damaged, Obscured'),
(2, 2, 'Accident Damage'),
(3, 2, 'Incorrect Alignment'),
(4, 2, 'Connection to Bridge'),
(5, 2, 'Delineators'),
(6, 3, 'Blocked Inlets/Outlets'),
(7, 3, 'Scour of Outlets/Embarkments'),
(8, 4, 'Material Defects - Concrete'),
(9, 4, 'Material Defects - Surfacing'),
(10, 4, 'Settlement, Depressions'),
(11, 4, 'Rough Joint Transition'),
(12, 5, 'Material Defects - Surfacing'),
(13, 5, 'Material Defects - Concrete'),
(14, 5, 'Material Defects - Timber'),
(15, 5, 'Scuppers'),
(16, 6, 'Clean'),
(17, 6, 'Even'),
(18, 7, 'Impact Damage'),
(19, 7, 'Loose/Damaged Fixings'),
(20, 7, 'Loose Post Base'),
(21, 7, 'Material Defects'),
(22, 7, 'Delineators'),
(23, 8, 'Loose/Damaged Fixings'),
(24, 8, 'Damaged/Missing Seals'),
(25, 8, 'Deck/Nosing/Ballast Wall Damage'),
(26, 8, 'Obstructions in Gap'),
(27, 9, 'Trees or Bushes under Bridge'),
(28, 9, 'Debris against Structure'),
(29, 9, 'Riverbank/Embankment Erosion'),
(30, 9, 'Scour Holes in Bed'),
(31, 9, 'Damaged Bed Protection'),
(32, 10, 'Material Defects - Piles'),
(33, 10, 'Material Defects - Footings'),
(34, 10, 'Material Defects - Walls/Stems'),
(35, 10, 'Headstocks'),
(36, 11, 'Forward Movement of Abutments/Wings'),
(37, 11, 'Blocked Drains/Weepholes'),
(38, 11, 'Debris on Shelf/Bearing'),
(39, 11, 'Scour/Erosion of Spillthrough'),
(40, 11, 'Dampness/Leakage from Deck'),
(41, 11, 'Substucture Protection'),
(42, 12, 'Gap Closed/Decks in Contact/Damaged'),
(43, 12, 'Bearing Displaced/Damaged'),
(44, 12, 'Poorly Seated'),
(45, 12, 'Corroded/Seized/No Lubricant'),
(46, 13, 'Girders'),
(47, 13, 'Cross Girders'),
(48, 13, 'Deck'),
(49, 13, 'Coatings'),
(52, 14, 'Debris/Dirt build up'),
(53, 14, 'Impact Damage'),
(54, 14, 'Excessive Movement/Vibration'),
(55, 14, 'Dampness'),
(56, 14, 'Ventholes'),
(57, 15, 'Fastners/Brackets'),
(58, 15, 'Pipe/Conduit'),
(59, 15, 'Openings'),
(62, 16, 'Delineation'),
(63, 16, 'Barriers'),
(64, 16, 'Road Drainage'),
(65, 17, 'Walls'),
(66, 17, 'Roofs'),
(67, 17, 'Aprons'),
(68, 17, 'Wingwalls/Headwalls'),
(69, 17, 'Steel Culverts'),
(60, 15, 'Service Duct'),
(61, 15, 'Drainage System'),
(50, 13, 'Tie Rod'),
(51, 13, 'Spandrels');


CREATE TABLE IF NOT EXISTS `bms_inspection2datas` (
  `Inspection2DataID` int(11) NOT NULL AUTO_INCREMENT,
  `bms_inspection2headerdatas_Inspection2HeaderDataID` int(11) NOT NULL,
  `ival` int(11) NOT NULL,
  `Filmnumber` varchar(500) NOT NULL,
  `Sketchnumber` varchar(500) NOT NULL,
  `Modification` varchar(500) NOT NULL,
  `Group` varchar(500) NOT NULL,
  `Component` varchar(500) NOT NULL,
  `Filext` varchar(20) NOT NULL,
  `Description` varchar(500) NOT NULL,
  PRIMARY KEY (`Inspection2DataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;


CREATE TABLE IF NOT EXISTS `bms_inspection2headerdatas` (
  `Inspection2HeaderDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `InspectionDate` date NOT NULL,
  `NextInspectionDate` date NOT NULL,
  `Level1Inspection` enum('p','e') NOT NULL DEFAULT 'p',
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Inspection2HeaderDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


INSERT INTO `bms_inspection2headerdatas` (`Inspection2HeaderDataID`, `bridgeprofile_BridgeProfileID`, `InspectionDate`, `NextInspectionDate`, `Level1Inspection`, `ModifiedBy`, `ModifiedDate`, `AddedBy`, `AddedDate`) VALUES
(9, 69, '2012-06-25', '2012-06-30', 'p', 0, '2012-06-21 08:59:22', 1, '2012-06-21 08:59:22');


CREATE TABLE IF NOT EXISTS `bms_inspection3defcomdatas` (
  `Inspection3DefcomDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bms_inspection3headerdatas_Inspection3HeaderDataID` int(11) NOT NULL,
  `Modification` enum('o','m1','m2','m3','-') NOT NULL DEFAULT '-',
  `ival` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixGroupVal` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixVal_CM` int(11) NOT NULL,
  `bms_inspection3stcompschedule_Inspection3StcompScheduleID` int(11) NOT NULL DEFAULT '0',
  `ExporsureClass` int(11) NOT NULL,
  `ConditionState` int(11) NOT NULL,
  `Monitor` enum('y','n','-') NOT NULL DEFAULT '-',
  `Level3Inspection` enum('y','n','-') NOT NULL DEFAULT '-',
  `Other` enum('y','n','-') NOT NULL DEFAULT '-',
  `Comments` text NOT NULL,
  PRIMARY KEY (`Inspection3DefcomDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=661 ;


CREATE TABLE IF NOT EXISTS `bms_inspection3headerdatas` (
  `Inspection3HeaderDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `InspectionDate` date NOT NULL,
  `NextInspectionDate` date NOT NULL,
  `Level2Inspection` enum('p','e','u') NOT NULL DEFAULT 'p',
  `GeneralComment` text NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Inspection3HeaderDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


CREATE TABLE IF NOT EXISTS `bms_inspection3photosketchdatas` (
  `Inspection3PhotoSketchDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bms_inspection3headerdatas_Inspection3HeaderDataID` int(11) NOT NULL,
  `Modification` enum('o','m1','m2','m3','-') NOT NULL DEFAULT '-',
  `ival` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixGroupVal` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixVal_CM` int(11) NOT NULL,
  `Filext1` varchar(20) NOT NULL,
  `Filext2` varchar(20) NOT NULL,
  `Filext3` varchar(20) NOT NULL,
  `Filext4` varchar(20) NOT NULL,
  `Filext5` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `SketchNo` varchar(200) NOT NULL,
  PRIMARY KEY (`Inspection3PhotoSketchDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=581 ;


CREATE TABLE IF NOT EXISTS `bms_inspection3stcompmatrix` (
  `Inspection3StcompMatrixID` int(20) NOT NULL AUTO_INCREMENT,
  `StcompMatrixCode` varchar(20) NOT NULL,
  `StcompMatrixDesc` varchar(200) NOT NULL,
  `SignificanceRating` int(11) NOT NULL,
  PRIMARY KEY (`Inspection3StcompMatrixID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;



INSERT INTO `bms_inspection3stcompmatrix` (`Inspection3StcompMatrixID`, `StcompMatrixCode`, `StcompMatrixDesc`, `SignificanceRating`) VALUES
(1, 'A', 'Abutment', 3),
(2, 'ABS', 'Abutment Sheeting', 2),
(3, 'AP', 'Approach', 2),
(4, 'ARH', 'Arch', 4),
(5, 'PRO', 'Batter Protection', 1),
(6, 'B', 'Bearing', 2),
(7, 'PED', 'Bearing Pedestals', 1),
(8, 'WAL', 'Bracing Wale', 3),
(9, 'BR', 'Bridge Barriers', 1),
(10, 'C', 'Columns', 4),
(11, 'COR', 'Corbels', 3),
(12, 'XB', 'Cross Beam', 3),
(13, 'XG', 'Cross Girder', 3),
(14, 'D', 'Deck', 3),
(15, 'F', 'Footing', 3),
(16, 'FY', 'Footway', 1),
(17, 'G', 'Girders', 4),
(18, 'GR', 'Guard Rails', 1),
(19, 'HR', 'Hanger', 4),
(20, 'H', 'Headstock', 4),
(21, 'HW', 'Headwall', 1),
(22, 'J', 'Joints', 2),
(23, 'K', 'Kerb', 1),
(24, 'MP', 'Mortar Pad', 1),
(25, 'PW', 'Pier Wall', 3),
(26, 'P', 'Piles and Encasements', 4),
(27, 'CAP', 'Pilecap', 3),
(28, 'RA', 'Restraint Angle', 2),
(29, 'RW', 'Retaining Wall', 3),
(30, 'SL', 'Sill Log', 3),
(31, 'SP', 'Spiking Plank', 1),
(32, 'TT', 'Through Truss', 4),
(33, 'W', 'Waterway', 2),
(34, 'WS', 'Wearing Surface/Fill', 2),
(35, 'WW', 'Wingwalls', 3),
(36, 'AC', 'Arch Culvert', 2),
(37, 'BC', 'Box Culvert', 2),
(38, 'MC', 'Modular Culvert', 2),
(39, 'PC', 'Pipe Culvert', 2),
(40, 'CBS', 'Culvert Base Slab', 3),
(0, '---', '---', 0);


CREATE TABLE IF NOT EXISTS `bms_inspection3stcompmatrixgroup` (
  `Inspection3StcompMatrixGroupID` int(20) NOT NULL AUTO_INCREMENT,
  `StcompMatrixGroupCode` varchar(20) NOT NULL,
  `StcompMatrixGroupDesc` varchar(200) NOT NULL,
  PRIMARY KEY (`Inspection3StcompMatrixGroupID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `bms_inspection3stcompmatrixgroup` (`Inspection3StcompMatrixGroupID`, `StcompMatrixGroupCode`, `StcompMatrixGroupDesc`) VALUES
(1, 'A', 'Abutments'),
(2, 'P', 'Piers'),
(3, 'S', 'Spans/Cells'),
(4, 'AP', 'Approach'),
(0, '---', '---');



CREATE TABLE IF NOT EXISTS `bms_inspection3stcompschedule` (
  `Inspection3StcompScheduleID` int(20) NOT NULL AUTO_INCREMENT,
  `Inspection3StcompScheduleNo` varchar(20) NOT NULL,
  `Inspection3StcompScheduleDesc` varchar(200) NOT NULL,
  `Inspection3StcompScheduleUnit` varchar(200) NOT NULL,
  PRIMARY KEY (`Inspection3StcompScheduleID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;



INSERT INTO `bms_inspection3stcompschedule` (`Inspection3StcompScheduleID`, `Inspection3StcompScheduleNo`, `Inspection3StcompScheduleDesc`, `Inspection3StcompScheduleUnit`) VALUES
(1, '1C', 'Fill/Wearing Surface on Deck', 'Sqr m'),
(2, '1O', 'Fill/Wearing Surface on Deck', 'Sqr m'),
(3, '2S', 'Bridge Railing/Barriers', 'Lin m'),
(4, '2P', 'Bridge Railing/Barriers', 'Lin m'),
(5, '2C', 'Bridge Railing/Barriers', 'Lin m'),
(6, '2T', 'Bridge Railing/Barriers', 'Lin m'),
(7, '2O', 'Bridge Railing/Barriers', 'Lin m'),
(8, '3P', 'Bridge Kerbs', 'Lin m'),
(9, '3C', 'Bridge Kerbs', 'Lin m'),
(10, '3T', 'Bridge Kerbs', 'Lin m'),
(11, '4S', 'Footways', 'Lin m'),
(12, '4P', 'Footways', 'Lin m'),
(13, '4C', 'Footways', 'Lin m'),
(14, '4T', 'Footways', 'Lin m'),
(15, '4O', 'Footways', 'Lin m'),
(16, '10O', 'Pourable Joint Seal', 'Lin m'),
(17, '11O', 'Compression Joint Seal', 'Lin m'),
(18, '12O', 'Assembly Joint Seal', 'Lin m'),
(19, '13S', 'Open Expansion Joint', 'Lin m'),
(20, '13O', 'Open Expansion Joint', 'Lin m'),
(21, '14S', 'Sliding Joint', 'Lin m'),
(22, '15O', 'Fixed/Small Movement Joints', 'Lin m'),
(23, '20P', 'Deck Slab/Culvert Base Slab', 'Each'),
(24, '20C', 'Deck Slab/Culvert Base Slab', 'Sqr m'),
(25, '20T', 'Deck Slab/Culvert Base Slab', 'Sqr m'),
(26, '21S', 'Closed Web/Box Girders', 'Lin m'),
(27, '21P', 'Closed Web/Box Girders', 'Lin m'),
(28, '21C', 'Closed Web/Box Girders', 'Lin m'),
(29, '22S', 'Open Girders', 'Each'),
(30, '22P', 'Open Girders', 'Each'),
(31, '22C', 'Open Girders', 'Each'),
(32, '22T', 'Open Girders', 'Each'),
(33, '23S', 'Through Truss', 'Lin m'),
(34, '24S', 'Deck Truss', 'Lin m'),
(35, '25S', 'Arches', 'Lin m'),
(36, '25P', 'Arches', 'Lin m'),
(37, '25C', 'Arches', 'Lin m'),
(38, '25O', 'Arches', 'Lin m'),
(39, '26S', 'Cables/Hangers', 'Each'),
(40, '27C', 'Corbels', 'Each'),
(41, '27T', 'Corbels', 'Each'),
(42, '28S', 'Cross Beams/Floor Beams', 'Each'),
(43, '28T', 'Cross Beams/Floor Beams', 'Each'),
(44, '29P', 'Deck Plans', 'Each'),
(45, '29T', 'Deck Plans', 'Sqr m'),
(46, '30S', 'Steel Decking', 'Sqr m'),
(47, '31S', 'Diaphragms/Bracing (Cross Girders)', 'Each'),
(48, '31C', 'Diaphragms/Bracing (Cross Girders)', 'Each'),
(49, '32C', 'Load Bearing Diaphragms', 'Each'),
(50, '33T', 'Spinking Plank', 'Lin m'),
(51, '40O', 'Fixed Bearing', 'Each'),
(52, '41O', 'Sliding Bearing', 'Each'),
(53, '42O', 'Elastomeric/Pot Bearings', 'Each'),
(54, '43S', 'Rockers/Rollers', 'Each'),
(55, '44O', 'Mortar Pads/Bearing Pedastals', 'Each'),
(56, '45S', 'Restraint Angles/Blocks', 'Each'),
(57, '45O', 'Restraint Angles/Blocks', 'Each'),
(58, '50C', 'Abutment', 'Each'),
(59, '50O', 'Abutment', 'Each'),
(60, '51S', 'Wingwalls/Retaining Wall', 'Each'),
(61, '51P', 'Wingwalls/Retaining Wall', 'Each'),
(62, '51C', 'Wingwalls/Retaining Wall', 'Each'),
(63, '51T', 'Wingwalls/Retaining Wall', 'Each'),
(64, '51O', 'Wingwalls/Retaining Wall', 'Each'),
(65, '52S', 'Abutment Sheeting/Infill Panels', 'Sqr m'),
(66, '52P', 'Abutment Sheeting/Infill Panels', 'Sqr m'),
(67, '52C', 'Abutment Sheeting/Infill Panels', 'Sqr m'),
(68, '52T', 'Abutment Sheeting/Infill Panels', 'Sqr m'),
(69, '52O', 'Abutment Sheeting/Infill Panels', 'Sqr m'),
(70, '53P', 'Batter Protection', 'Sqr m'),
(71, '53C', 'Batter Protection', 'Sqr m'),
(72, '53O', 'Batter Protection', 'Sqr m'),
(73, '54S', 'Headstocks', 'Each'),
(74, '54P', 'Headstocks', 'Each'),
(75, '54C', 'Headstocks', 'Each'),
(76, '54T', 'Headstocks', 'Each'),
(77, '55C', 'Pier Headstocks (Intergral)', 'Each'),
(78, '56S', 'Columns or Piles (Encasement)', 'Each'),
(79, '56P', 'Columns or Piles (Encasement)', 'Each'),
(80, '56C', 'Columns or Piles (Encasement)', 'Each'),
(81, '56T', 'Columns or Piles (Encasement)', 'Each'),
(82, '56O', 'Columns or Piles (Encasement)', 'Each'),
(83, '57S', 'Pile Bracing/Wales', 'Each'),
(84, '57C', 'Pile Bracing/Wales', 'Each'),
(85, '57T', 'Pile Bracing/Wales', 'Each'),
(86, '58C', 'Pier Walls', 'Sqr m'),
(87, '58O', 'Pier Walls', 'Sqr m'),
(88, '59C', 'Footing/Pile Cap/Sill Log', 'Each'),
(89, '59T', 'Footing/Pile Cap/Sill Log', 'Each'),
(90, '60S', 'Wing Piles', 'Each'),
(91, '60P', 'Wing Piles', 'Each'),
(92, '60T', 'Wing Piles', 'Each'),
(93, '70O', 'Bridge Approaches', 'Each'),
(94, '71C', 'Waterway', 'Each'),
(95, '71O', 'Waterway', 'Each'),
(96, '72S', 'Approach Guardrail', 'Each'),
(97, '72P', 'Approach Guardrail', 'Each'),
(98, '72C', 'Approach Guardrail', 'Each'),
(99, '72T', 'Approach Guardrail', 'Each'),
(100, '72O', 'Approach Guardrail', 'Each'),
(101, '80S', 'Pipe Culverts', 'Lin m'),
(102, '80P', 'Pipe Culverts', 'Lin m'),
(103, '80O', 'Pipe Culverts', 'Lin m'),
(104, '81P', 'Box Culverts', 'Lin m'),
(105, '81C', 'Box Culverts', 'Lin m'),
(106, '82P', 'Modular Culverts', 'Lin m'),
(107, '83S', 'Arch Culverts', 'Lin m'),
(108, '83P', 'Arch Culverts', 'Lin m'),
(109, '83C', 'Arch Culverts', 'Lin m'),
(110, '83O', 'Arch Culverts', 'Lin m'),
(111, '84P', 'Headwalls/Wingwalls', 'Each'),
(112, '84C', 'Headwalls/Wingwalls', 'Each'),
(113, '84O', 'Headwalls/Wingwalls', 'Each'),
(0, '---', '---', '---'),
(114, 'Other', 'Other', 'Other');



CREATE TABLE IF NOT EXISTS `bms_inspection3stconinsdatas` (
  `Inspection3StconInsDataID` int(11) NOT NULL AUTO_INCREMENT,
  `bms_inspection3headerdatas_Inspection3HeaderDataID` int(11) NOT NULL,
  `Modification` enum('o','m1','m2','m3','-') NOT NULL DEFAULT '-',
  `ival` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixGroupVal` int(11) NOT NULL,
  `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` int(11) NOT NULL DEFAULT '0',
  `Inspection3StcompMatrixVal_CM` int(11) NOT NULL,
  `bms_inspection3stcompschedule_Inspection3StcompScheduleID` int(11) NOT NULL DEFAULT '0',
  `ExporsureClass` int(11) NOT NULL,
  `ImportanceFactor` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `QuantityConState_1` tinyint(1) NOT NULL,
  `QuantityConState_2` tinyint(1) NOT NULL,
  `QuantityConState_3` tinyint(1) NOT NULL,
  `QuantityConState_4` tinyint(1) NOT NULL,
  `MaintainRequired` enum('y','n','-') NOT NULL DEFAULT '-',
  `PhotosTaken` enum('y','n','-') NOT NULL DEFAULT '-',
  `Comments` text NOT NULL,
  PRIMARY KEY (`Inspection3StconInsDataID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15391 ;

CREATE TABLE IF NOT EXISTS `bms_loadingfactors` (
  `LoadingFactorID` int(11) NOT NULL AUTO_INCREMENT,
  `LoadingFactorName` varchar(50) NOT NULL,
  `LoadingFactor` int(11) NOT NULL,
  PRIMARY KEY (`LoadingFactorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_loadingfactors` (`LoadingFactorID`, `LoadingFactorName`, `LoadingFactor`) VALUES
(1, '0-500', 1),
(2, '500-1000', 2),
(3, '1000-2000', 3),
(4, '2000-4000', 4),
(5, '>4000', 5);


CREATE TABLE IF NOT EXISTS `bms_localenvironments` (
  `LocalEnvironmentID` int(5) NOT NULL AUTO_INCREMENT,
  `LocalEnvironment` varchar(200) NOT NULL,
  PRIMARY KEY (`LocalEnvironmentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `bms_localenvironments` (`LocalEnvironmentID`, `LocalEnvironment`) VALUES
(1, 'LocalEnvironment'),
(2, 'LocalEnvironment 2'),
(3, 'LocalEnvironment 3');



CREATE TABLE IF NOT EXISTS `bms_login_logs` (
  `LoginLogsID` bigint(25) NOT NULL AUTO_INCREMENT,
  `users_UserID` int(11) DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `ProxyIP` varchar(20) DEFAULT NULL,
  `Environment` text,
  `LoginTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LoginLogsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;



CREATE TABLE IF NOT EXISTS `bms_logs` (
  `LogID` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_UserID` int(11) NOT NULL DEFAULT '0',
  `TableName` varchar(40) NOT NULL,
  `SQLQuery` text NOT NULL,
  `Action` varchar(150) NOT NULL,
  `Other` text NOT NULL,
  `LogedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`LogID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=17349 ;



CREATE TABLE IF NOT EXISTS `bms_operationalstatuses` (
  `OperationalStatusID` int(5) NOT NULL AUTO_INCREMENT,
  `OperationalStatus` varchar(200) NOT NULL,
  PRIMARY KEY (`OperationalStatusID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_operationalstatuses` (`OperationalStatusID`, `OperationalStatus`) VALUES
(1, 'Under Construction'),
(2, 'Open to Traffic'),
(3, 'Closed');



CREATE TABLE IF NOT EXISTS `bms_operationalstatusesrecord` (
  `OperationalStatusesRecordID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `operationalstatuses_OperationalStatusID` int(7) NOT NULL,
  `OperationalStatusDate` date NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`OperationalStatusesRecordID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195 ;


CREATE TABLE IF NOT EXISTS `bms_owners` (
  `OwnerID` int(5) NOT NULL AUTO_INCREMENT,
  `OwnerName` varchar(200) NOT NULL,
  PRIMARY KEY (`OwnerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `bms_owners` (`OwnerID`, `OwnerName`) VALUES
(1, 'Centeral Goverment'),
(2, 'State');


CREATE TABLE IF NOT EXISTS `bms_parapettypes` (
  `ParapetTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ParapetType` varchar(200) NOT NULL,
  PRIMARY KEY (`ParapetTypeID`),
  UNIQUE KEY `ParapetType` (`ParapetType`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_parapettypes` (`ParapetTypeID`, `ParapetType`) VALUES
(1, 'Concrete'),
(2, 'Steel'),
(3, 'Timber'),
(4, 'Other');



CREATE TABLE IF NOT EXISTS `bms_pierfoundationmaterials` (
  `PierFoundationMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `PierFoundationMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`PierFoundationMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `bms_pierfoundationmaterials` (`PierFoundationMaterialID`, `PierFoundationMaterial`) VALUES
(1, 'Prestressed Concrete'),
(2, 'RC'),
(3, 'Concrete'),
(4, 'Steel'),
(5, 'Timber');



CREATE TABLE IF NOT EXISTS `bms_pierfoundations` (
  `PierFoundationID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `PierNumber` int(3) NOT NULL,
  `pierfoundationtypes_PierFoundationTypeID` int(11) NOT NULL,
  `pierfoundationmaterials_PierFoundationMaterialID` int(7) NOT NULL,
  `Comments` varchar(500) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PierFoundationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=309 ;


CREATE TABLE IF NOT EXISTS `bms_pierfoundationtypes` (
  `PierFoundationTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `PierFoundationType` varchar(200) NOT NULL,
  PRIMARY KEY (`PierFoundationTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



INSERT INTO `bms_pierfoundationtypes` (`PierFoundationTypeID`, `PierFoundationType`) VALUES
(1, 'Spread Footing'),
(2, 'Piles'),
(3, 'Cylinders'),
(4, 'Reinforced Earth');


CREATE TABLE IF NOT EXISTS `bms_piermaterials` (
  `PierMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `PierMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`PierMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_piermaterials` (`PierMaterialID`, `PierMaterial`) VALUES
(1, 'RC'),
(2, 'Mass Concrete'),
(3, 'Stone'),
(4, 'Steel'),
(5, 'Other');



CREATE TABLE IF NOT EXISTS `bms_piers` (
  `PierID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `PierNumber` int(3) NOT NULL,
  `piertypes_PierTypeID` int(11) NOT NULL,
  `piermaterials_PierMaterialID` int(7) NOT NULL,
  `ThicknessCappingLevel` decimal(5,4) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PierID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=309 ;


CREATE TABLE IF NOT EXISTS `bms_piertypes` (
  `PierTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `PierType` varchar(200) NOT NULL,
  PRIMARY KEY (`PierTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `bms_piertypes` (`PierTypeID`, `PierType`) VALUES
(1, 'Solid'),
(2, 'Trestle'),
(3, 'Hammer Head'),
(4, 'Framed Pier'),
(5, 'Cellular Type'),
(6, 'Other');

CREATE TABLE IF NOT EXISTS `bms_privileges` (
  `PrivilegeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(200) DEFAULT NULL,
  `ActionMapping` varchar(500) NOT NULL DEFAULT '',
  `menusubcategory_menusubcategoryID` int(4) NOT NULL,
  `AddedBy` bigint(20) DEFAULT NULL,
  `AddedDate` date DEFAULT NULL,
  `LastModifiedBy` bigint(20) DEFAULT NULL,
  `LastModifiedDate` date DEFAULT NULL,
  PRIMARY KEY (`PrivilegeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=511 ;


INSERT INTO `bms_privileges` (`PrivilegeID`, `Description`, `ActionMapping`, `menusubcategory_menusubcategoryID`, `AddedBy`, `AddedDate`, `LastModifiedBy`, `LastModifiedDate`) VALUES
(1, 'Edit My Profile', '', 0, NULL, NULL, NULL, NULL),
(2, 'Edit My Password', '', 0, NULL, NULL, NULL, NULL),
(50, 'New Bridge', 'bridge/add_bridge.php', 0, NULL, NULL, NULL, NULL),
(52, 'View Bridge', 'bridge/view_bridge.php', 0, NULL, NULL, NULL, NULL),
(51, 'Edit Bridge', 'bridge/edit_bridge.php', 0, NULL, NULL, NULL, NULL),
(10, 'New User', 'users/user_add.php', 0, NULL, NULL, NULL, NULL),
(11, 'View User Profile', 'users/user_view.php', 0, NULL, NULL, NULL, NULL),
(12, 'Edit User Profile', 'users/user_edit.php', 0, NULL, NULL, NULL, NULL),
(15, 'User Privileges', 'users/user_usertype.php', 0, NULL, NULL, NULL, NULL),
(16, 'Privilege Manage', 'users/privilege_manage.php', 0, NULL, NULL, NULL, NULL),
(100, 'Add Level 1-A Inspection', 'inspection1/add_inspection1.php', 0, NULL, NULL, NULL, NULL),
(101, 'Edit Level 1-A Inspection', 'inspection1/edit_inspection1.php', 0, NULL, NULL, NULL, NULL),
(102, 'View Level 1-A Inspection', 'inspection1/view_inspection1.php', 0, NULL, NULL, NULL, NULL),
(201, 'Download Monitoring Form (i)', 'download/mt1.php', 0, NULL, NULL, NULL, NULL),
(202, 'Upload Monitoring Form (i)', 'upload/mt1.php', 0, NULL, NULL, NULL, NULL),
(211, 'Download Monitoring Form (ii)', 'download/mt2.php', 0, NULL, NULL, NULL, NULL),
(212, 'Upload Monitoring Form (ii)', 'upload/mt2.php', 0, NULL, NULL, NULL, NULL),
(221, 'Download Monitoring Form (iii)', 'download/mt3.php', 0, NULL, NULL, NULL, NULL),
(222, 'Upload Monitoring Form (iii)', 'upload/mt3.php', 0, NULL, NULL, NULL, NULL),
(300, 'Bridge Report - I', 'bridge/report_bridgeposition.php', 0, NULL, NULL, NULL, NULL),
(301, 'Bridge Report - II', 'bridge/report_bridgeproperties.php', 0, NULL, NULL, NULL, NULL),
(110, 'Add Level 1-B Inspection', 'inspection1/add_inspection2.php', 0, NULL, NULL, NULL, NULL),
(111, 'Edit Level 1-B Inspection', 'inspection1/edit_inspection2.php', 0, NULL, NULL, NULL, NULL),
(112, 'View Level 1-B Inspection', 'inspection1/view_inspection2.php', 0, NULL, NULL, NULL, NULL),
(150, 'Add Level 2 Inspection', 'inspection2/add_inspection3.php', 0, NULL, NULL, NULL, NULL),
(151, 'Edit Level 2 Inspection', 'inspection2/edit_inspection3.php', 0, NULL, NULL, NULL, NULL),
(152, 'View Level 2 Inspection', 'inspection2/view_inspection3.php', 0, NULL, NULL, NULL, NULL),
(302, 'Bridge Report - III', 'bridge/report_bridgeriskreq2.php', 0, NULL, NULL, NULL, NULL),
(350, 'Help - Component List', 'help/help_componentlist.php', 0, NULL, NULL, NULL, NULL),
(351, 'Help - Standars Numbers', 'help/help_standardnumbers.php', 0, NULL, NULL, NULL, NULL),
(352, 'Help - Group List', 'help/help_grouplist.php', 0, NULL, NULL, NULL, NULL),
(175, 'Risk Analysis', 'risk/risk_analysis.php', 0, NULL, NULL, NULL, NULL),
(176, 'Risk Analysis Report', 'risk/risk_analysis_report.php', 0, NULL, NULL, NULL, NULL);


CREATE TABLE IF NOT EXISTS `bms_provinces` (
  `ProvinceID` int(11) NOT NULL AUTO_INCREMENT,
  `Province` varchar(100) NOT NULL,
  PRIMARY KEY (`ProvinceID`),
  UNIQUE KEY `Province` (`Province`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


CREATE TABLE IF NOT EXISTS `bms_railroadnames` (
  `RailRoadNameID` int(5) NOT NULL AUTO_INCREMENT,
  `RailRoadName` varchar(200) NOT NULL,
  PRIMARY KEY (`RailRoadNameID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;




CREATE TABLE IF NOT EXISTS `bms_rivers` (
  `RiverID` int(5) NOT NULL AUTO_INCREMENT,
  `RiverName` varchar(200) NOT NULL,
  PRIMARY KEY (`RiverID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


INSERT INTO `bms_rivers` (`RiverID`, `RiverName`) VALUES
(1, 'Unclassified');



CREATE TABLE IF NOT EXISTS `bms_roadclasses` (
  `RoadClassID` int(11) NOT NULL AUTO_INCREMENT,
  `RoadClass` varchar(100) NOT NULL,
  PRIMARY KEY (`RoadClassID`),
  UNIQUE KEY `RoadClass` (`RoadClass`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `bms_roadclasses` (`RoadClassID`, `RoadClass`) VALUES
(1, 'Class B'),
(3, 'Class A'),
(7, 'Expressway');



CREATE TABLE IF NOT EXISTS `bms_roadnames` (
  `RoadNameID` int(5) NOT NULL AUTO_INCREMENT,
  `RoadName` varchar(200) NOT NULL,
  PRIMARY KEY (`RoadNameID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `bms_roadnames` (`RoadNameID`, `RoadName`) VALUES
(1, 'M1 Expressway');


CREATE TABLE IF NOT EXISTS `bms_routenos` (
  `RouteNoID` int(11) NOT NULL AUTO_INCREMENT,
  `RouteNo` varchar(100) NOT NULL,
  PRIMARY KEY (`RouteNoID`),
  UNIQUE KEY `RouteNo` (`RouteNo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `bms_routenos` (`RouteNoID`, `RouteNo`) VALUES
(1, 'M01');


CREATE TABLE IF NOT EXISTS `bms_sections` (
  `SectionID` int(5) NOT NULL AUTO_INCREMENT,
  `SectionName` varchar(200) NOT NULL,
  PRIMARY KEY (`SectionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `bms_sections` (`SectionID`, `SectionName`) VALUES
(1, 'M1 Highway');


CREATE TABLE IF NOT EXISTS `bms_spangroup` (
  `SpanGroupID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `YearOfConstruction` int(4) NOT NULL,
  `SpanNumber` int(3) NOT NULL,
  `SpanLength` double(10,2) NOT NULL,
  `spanmaterials_SpanMaterialID` int(11) NOT NULL,
  `SpanType` varchar(200) NOT NULL,
  `Original` enum('o','w') NOT NULL DEFAULT 'o',
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SpanGroupID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=362 ;


CREATE TABLE IF NOT EXISTS `bms_spanmaterials` (
  `SpanMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `SpanMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`SpanMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `bms_spanmaterials` (`SpanMaterialID`, `SpanMaterial`) VALUES
(1, 'Prestressed Concrete'),
(2, 'RC Slab'),
(3, 'Steel'),
(4, 'Timber'),
(5, 'Other');



CREATE TABLE IF NOT EXISTS `bms_spantypes` (
  `SpanTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `SpanType` varchar(200) NOT NULL,
  PRIMARY KEY (`SpanTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;



INSERT INTO `bms_spantypes` (`SpanTypeID`, `SpanType`) VALUES
(1, 'Skew'),
(2, 'Square');



CREATE TABLE IF NOT EXISTS `bms_structuretypes` (
  `StructureTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `StructureTypeName` varchar(200) NOT NULL,
  PRIMARY KEY (`StructureTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `bms_structuretypes` (`StructureTypeID`, `StructureTypeName`) VALUES
(1, 'Bridge'),
(2, 'Culvert'),
(3, 'Other');



CREATE TABLE IF NOT EXISTS `bms_users` (
  `UserID` int(5) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `sections_SectionID` int(11) NOT NULL DEFAULT '1',
  `NameWithInitials` varchar(500) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Title` varchar(10) NOT NULL,
  `TeleNum` varchar(20) NOT NULL,
  `eMail` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Active` enum('0','1') NOT NULL DEFAULT '1',
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastloginTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`,`NameWithInitials`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;



INSERT INTO `bms_users` (`UserID`, `Username`, `Password`, `sections_SectionID`, `NameWithInitials`, `FirstName`, `LastName`, `Title`, `TeleNum`, `eMail`, `Address`, `Active`, `ModifiedBy`, `ModifiedDate`, `AddedBy`, `AddedDate`, `LastloginTime`) VALUES
(1, 'admin', '372e6da82eca0b24f93d973a38e3c3d8', 1, 'Admin User', 'Admin', 'User', 'Mr.', '0716-832362', 'admin@bms', 'Bridge Managment System', '1', 1, '', 0, '', '0');


CREATE TABLE IF NOT EXISTS `bms_users_usertypes` (
  `UserUserTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `users_UserID` int(11) NOT NULL,
  `usertypes_UserTypeID` int(11) NOT NULL,
  PRIMARY KEY (`UserUserTypeID`),
  UNIQUE KEY `users_UserID` (`users_UserID`,`usertypes_UserTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;


INSERT INTO `bms_users_usertypes` (`UserUserTypeID`, `users_UserID`, `usertypes_UserTypeID`) VALUES
(58, 1, 5),
(62, 1, 9),
(10, 3, 2),
(60, 1, 7),
(5, 2, 5),
(6, 2, 2),
(7, 2, 6),
(8, 2, 4),
(61, 1, 8),
(14, 4, 1),
(15, 3, 1),
(16, 3, 3),
(17, 3, 4),
(18, 3, 6),
(19, 5, 1),
(20, 5, 2),
(21, 5, 3),
(22, 5, 4),
(23, 5, 6),
(59, 1, 2),
(32, 3, 7),
(33, 5, 7),
(34, 4, 7),
(37, 7, 1),
(36, 2, 7),
(38, 7, 2),
(39, 7, 3),
(40, 7, 4),
(41, 7, 5),
(42, 7, 6),
(43, 7, 7);


CREATE TABLE IF NOT EXISTS `bms_usertypes` (
  `UserTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `UserType` varchar(200) NOT NULL,
  PRIMARY KEY (`UserTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;



INSERT INTO `bms_usertypes` (`UserTypeID`, `UserType`) VALUES
(1, 'General User'),
(2, 'Head Office Engineer'),
(5, 'System Admin'),
(7, 'Help'),
(8, 'Report'),
(9, 'Inspection Engineer');



CREATE TABLE IF NOT EXISTS `bms_usertypes_privileges` (
  `UserTypePrivilegeID` int(5) NOT NULL AUTO_INCREMENT,
  `usertypes_UserTypeID` int(11) NOT NULL,
  `privileges_PrivilegeID` int(11) NOT NULL,
  PRIMARY KEY (`UserTypePrivilegeID`),
  UNIQUE KEY `usertypes_UserTypeID` (`usertypes_UserTypeID`,`privileges_PrivilegeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;



INSERT INTO `bms_usertypes_privileges` (`UserTypePrivilegeID`, `usertypes_UserTypeID`, `privileges_PrivilegeID`) VALUES
(17, 6, 103),
(26, 6, 110),
(33, 2, 51),
(32, 2, 50),
(15, 6, 101),
(6, 5, 15),
(7, 5, 16),
(8, 6, 100),
(9, 5, 10),
(10, 5, 11),
(11, 5, 12),
(34, 2, 52),
(35, 6, 102),
(75, 8, 300),
(38, 4, 152),
(37, 4, 151),
(28, 6, 112),
(27, 6, 111),
(76, 8, 301),
(77, 8, 302),
(36, 4, 150),
(62, 7, 350),
(80, 9, 101),
(79, 9, 100),
(78, 9, 52),
(74, 8, 176),
(63, 7, 351),
(73, 8, 175),
(69, 4, 176),
(70, 8, 102),
(72, 8, 152),
(64, 7, 352),
(66, 4, 175),
(71, 8, 112),
(58, 1, 2),
(57, 1, 1),
(81, 9, 102),
(82, 9, 110),
(83, 9, 111),
(84, 9, 112),
(85, 9, 150),
(86, 9, 151),
(87, 9, 152);

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `bms_wingfoundationmaterials` (
  `WingFoundationMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `WingFoundationMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`WingFoundationMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;



INSERT INTO `bms_wingfoundationmaterials` (`WingFoundationMaterialID`, `WingFoundationMaterial`) VALUES
(1, 'Prestressed Concrete'),
(2, 'RC'),
(3, 'Concrete'),
(4, 'Steel'),
(5, 'Timber');


CREATE TABLE IF NOT EXISTS `bms_wingfoundationtypes` (
  `WingFoundationTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `WingFoundationType` varchar(200) NOT NULL,
  PRIMARY KEY (`WingFoundationTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_wingfoundationtypes` (`WingFoundationTypeID`, `WingFoundationType`) VALUES
(1, 'Spread Footing'),
(2, 'Piles'),
(3, 'Cylinders'),
(4, 'Reinforced Earth');


CREATE TABLE IF NOT EXISTS `bms_wingmaterials` (
  `WingMaterialID` int(5) NOT NULL AUTO_INCREMENT,
  `WingMaterial` varchar(200) NOT NULL,
  PRIMARY KEY (`WingMaterialID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_wingmaterials` (`WingMaterialID`, `WingMaterial`) VALUES
(1, 'RC'),
(2, 'Mass Concrete'),
(3, 'Stone'),
(4, 'Steel');


CREATE TABLE IF NOT EXISTS `bms_wingtypes` (
  `WingTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `WingType` varchar(200) NOT NULL,
  PRIMARY KEY (`WingTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `bms_wingtypes` (`WingTypeID`, `WingType`) VALUES
(1, 'Cantilevered'),
(2, 'Gravity WW'),
(3, 'Counter Fort'),
(4, 'Reinforce Earth');


CREATE TABLE IF NOT EXISTS `bms_wingwallfoundations` (
  `PierFoundationID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `WingWallPosition` varchar(20) NOT NULL,
  `wingfoundationtypes_WingFoundationTypeID` int(11) NOT NULL,
  `wingfoundationmaterials_WingFoundationMaterialID` int(7) NOT NULL,
  `Comments` varchar(500) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PierFoundationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=777 ;


CREATE TABLE IF NOT EXISTS `bms_wingwalls` (
  `WingWallID` int(7) NOT NULL AUTO_INCREMENT,
  `bridgeprofile_BridgeProfileID` int(7) NOT NULL,
  `WingWallPosition` varchar(20) NOT NULL,
  `wingtypes_WingTypeID` int(11) NOT NULL,
  `wingmaterials_WingMaterialID` int(7) NOT NULL,
  `WingWallLenth` decimal(11,3) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`WingWallID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=777 ;
