CREATE DATABASE testProject;

CREATE TABLE testProject.Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(120) NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE testProject.Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    comment VARCHAR(720) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id)
);