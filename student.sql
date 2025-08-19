SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `student` (
  `stdid` int(11) NOT NULL,
  `stdic` varchar(100) NOT NULL,
  `stdmtx` varchar(100) NOT NULL,
  `stdname` varchar(100) NOT NULL,
  `stdfac` varchar(100) NOT NULL,
  `stdcrs` varchar(100) NOT NULL,
  `stdemail` varchar(100) NOT NULL,
  `stduser` varchar(100) NOT NULL,
  `stdpass` varchar(100) NOT NULL,
  `stdidph` longblob NOT NULL,
  `semid` int(11) NOT NULL,
  `lectid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `student`
  ADD PRIMARY KEY (`stdid`),
  ADD UNIQUE KEY `stdemail` (`stdemail`),
  ADD UNIQUE KEY `stduser` (`stduser`),
  ADD KEY `semid` (`semid`),
  ADD KEY `lectid` (`lectid`);

ALTER TABLE `student`
  MODIFY `stdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
