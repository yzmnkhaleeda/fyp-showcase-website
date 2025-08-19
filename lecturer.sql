SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `lecturer` (
  `lectid` int(11) NOT NULL,
  `lectname` varchar(100) NOT NULL,
  `lectfac` varchar(100) NOT NULL,
  `lectemail` varchar(100) NOT NULL,
  `lectuser` varchar(100) NOT NULL,
  `lectpass` varchar(100) NOT NULL,
  `lectidph` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lectid`),
  ADD UNIQUE KEY `lectemail` (`lectemail`,`lectuser`);

ALTER TABLE `lecturer`
  MODIFY `lectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;
