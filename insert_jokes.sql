INSERT INTO `author` SET
 `id` = 1,
 `name` = 'Kevin Yank',
 `email` = 'thatguy@kevinyank.com';

INSERT INTO `author` (`id`, `name`, `email`)
VALUES (2, 'Tom Butler', 'tom@r.je');

INSERT INTO `joke` SET
 `joketext` = "How many programmers does it take to screw in a lightbulb? None, it's a
hardware problem.",
 `jokedate` = '2017-04-01',
 `authorid` = 1;

INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`)
VALUES (
 "Why did the programmer quit his job? He didn't get arrays",
 '2017-04-01',
 1
);

INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`)
VALUES (
 "Why was the empty array stuck outside? It didn't have any keys",
 '2017-04-01',
 2
);
