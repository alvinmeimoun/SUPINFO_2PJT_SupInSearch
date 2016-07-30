SELECT  *
,       ((
          5 * (char_length(title) - char_length(replace(title,'oo',''))) +
          1 * (char_length(description) - char_length(replace(description,'oo',''))) +
			2 * (char_length(url) - char_length(replace(url,'oo','')))
        ) / char_length('oo')) +
		((
          5 * (char_length(title) - char_length(replace(title,'mo',''))) +
          1 * (char_length(description) - char_length(replace(description,'mo',''))) +
			2 * (char_length(url) - char_length(replace(url,'mo','')))
        ) / char_length('mo'))
		as Occurances
FROM supsearch.website
WHERE (url LIKE '%oo%' or title LIKE '%oo%' or description LIKE '%oo%') or (url LIKE '%mo%' or title LIKE '%mo%' or description LIKE '%mo%')
ORDER BY
        Occurances desc, title ASC