SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `project` (
  `pjid` int(11) NOT NULL,
  `pjtitle` varchar(100) NOT NULL,
  `pjabstract` varchar(3000) NOT NULL,
  `pjposter` longblob DEFAULT NULL,
  `pjvideo` longblob DEFAULT NULL,
  `pjstatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `pjgrade` varchar(100) NOT NULL,
  `stdid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `project`
  ADD PRIMARY KEY (`pjid`),
  ADD KEY `studid` (`stdid`),
  ADD KEY `stdid` (`stdid`);

ALTER TABLE `project`
  MODIFY `pjid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
