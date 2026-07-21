USE zfinance;

TRUNCATE TABLE users;
INSERT IGNORE INTO users(`name`,`email`,`pass`) 
  VALUES 
  ("henock","henoctumonakiese@gmail.com","$2y$12$mt8JfryNQHTal/b9PP056udorHZmPT6Xxc2WK1EDev2GS8p8GvPIS"),
  ("tshibaak","zaimon0123456789@gmail.com","$2y$12$rdFl.FnTwb67J2xNQq3HL.k7EdsY.7bnyO4Ds0Jlsdu/07kEh8iPy"),
  ("nicole","Nicolekandolo542@gmail.com","$2y$12$rdFl.FnTwb67J2xNQq3HL.k7EdsY.7bnyO4Ds0Jlsdu/07kEh8iPy"),
  ("jeremie","mbombojeremie11@gmail.com","$2y$12$15yRxzmy.NLJMnpSvw.ZYOqDKWfQzzV6DjSrEV.K9Yff2KiZQAsNq");