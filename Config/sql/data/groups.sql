--INSERT INTO groups ("name", "level", "perm_type", "redirect") VALUES ('admin',   100, 'allow', '/news/view');
--INSERT INTO groups ("name", "level", "perm_type", "redirect") VALUES ('users',   200, 'allow', '/news/view');

INSERT INTO groups ("name", "description" ) VALUES ('admin', 'Grupo de administradores'); 
INSERT INTO groups ("name", "description" ) VALUES ('users', 'Grupo de usuarios sin privilegios'); 
