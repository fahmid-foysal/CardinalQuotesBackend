const pool = require("../../config/database");

module.exports = {
    create: (data, callBack) => {
        pool.query(
            'INSERT INTO audios (category, name, audio_path, img_path) VALUES (?, ?, ?, ?)',
            [data.category, data.name, data.audio_path, data.img_path],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
    
audiosByCategory: (category, limit, offset, callBack) => {
    const query = `
        SELECT 
            a.id, 
            a.name, 
            a.img_path, 
            a.audio_path,
            a.view_count,
            GROUP_CONCAT(ak.keyword) AS keywords
        FROM 
            audios a
        LEFT JOIN 
            audio_keywords ak ON a.id = ak.audio_id
        WHERE 
            a.category = ?
        GROUP BY 
            a.id, a.name, a.img_path, a.audio_path
        LIMIT ? OFFSET ?;
    `;

    const countQuery = `SELECT COUNT(DISTINCT a.id) AS total FROM audios a WHERE a.category = ?`;

    pool.query(query, [category, limit, offset], (error, results) => {
        if (error) {
            return callBack(error);
        }

        const formattedResults = results.map(row => ({
            id: row.id,
            name: row.name,
            img_path: row.img_path,
            audio_path: row.audio_path,
            view_count: row.view_count,
            keywords: row.keywords ? row.keywords.split(',') : []
        }));

        // Now get total count
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
            'INSERT INTO audio_keywords (audio_id, keyword) VALUES (?, ?)',
            [data.audio_id, data.keyword],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },





};