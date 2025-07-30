const pool = require("../../config/database");

module.exports = {
    create: (data, callBack) => {
        pool.query(
            'INSERT INTO quotes (is_text, quote, category) VALUES (?, ?, ?)',
            [data.is_text, data.quote, data.category],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
    
quotesByCategory: (category, limit, offset, callBack) => {
    const query = `
        SELECT 
            q.id,
            q.quote,
            q.is_text,
            q.view_count,
            GROUP_CONCAT(qk.keyword) AS keywords
        FROM 
            quotes q
        LEFT JOIN 
            quote_keywords qk ON q.id = qk.quote_id
        WHERE 
            q.category = ?
        GROUP BY 
            q.id, q.quote, q.is_text
        LIMIT ? OFFSET ?
    `;

    const countQuery = `SELECT COUNT(DISTINCT q.id) AS total FROM quotes q WHERE q.category = ?`;

    pool.query(query, [category, limit, offset], (error, results) => {
        if (error) {
            return callBack(error);
        }

        const formattedResults = results.map(row => ({
            id: row.id,
            quote: row.quote,
            is_text: row.is_text,
            view_count: row.view_count,
            keywords: row.keywords ? row.keywords.split(',') : []
        }));

        pool.query(countQuery, [category], (countErr, countResults) => {
            if (countErr) {
                return callBack(countErr);
            }

            const totalCount = countResults[0].total;
            return callBack(null, formattedResults, totalCount);
        });
    });
},


            insertKeywrord: (data, callBack) => {
        pool.query(
            'INSERT INTO quote_keywords (quote_id, keyword) VALUES (?, ?)',
            [data.quote_id, data.keyword],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
};